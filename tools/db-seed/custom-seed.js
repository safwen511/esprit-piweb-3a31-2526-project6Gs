#!/usr/bin/env node
'use strict';

const mysql = require('mysql2/promise');
const fs = require('fs');
const path = require('path');

const APP_PROPS = path.resolve(__dirname, '..', '..', 'modules', 'common', 'resources', 'application.properties');
const AVATAR_BASE = 'C:\\Users\\safwe\\Desktop\\equipe';
const MAX_ROWS_PER_TABLE = 10;

const REAL_USERS = [
  {
    key: 'saf',
    firstName: 'Safwen',
    lastName: 'Yahyaoui',
    email: 'safwenyahyaoui047@gmail.com',
    password: '0473821736sS',
    roleType: 'client',
    phone: '0473821736'
  },
  {
    key: 'hamza',
    firstName: 'Hamza',
    lastName: 'Benyahia',
    email: 'Hamza.benyahia@esprit.tn',
    password: '0473821736sS',
    roleType: 'admin',
    phone: '0473821737'
  },
  {
    key: 'zak',
    firstName: 'Zakaria',
    lastName: 'Zarrouk',
    email: 'Zakaria.zarrouk@esprit.tn',
    password: '0473821736sS',
    roleType: 'admin',
    phone: '0473821738'
  },
  {
    key: 'youssef',
    firstName: 'Youssef',
    lastName: 'Tounsi',
    email: 'Youssef.Tounsi@esprit.tn',
    password: '0473821736sS',
    roleType: 'client',
    phone: '0473821739'
  },
  {
    key: 'djo',
    firstName: 'Joumena',
    lastName: 'Turki',
    email: 'joumena.turki@esprit.tn',
    password: '0473821736sS',
    roleType: 'client',
    phone: '0473821740'
  },
  {
    key: 'ilef',
    firstName: 'Ilef',
    lastName: 'Ben Chouchane',
    email: 'Ilef.BenChouchane@esprit.tn',
    password: '0473821736s',
    roleType: 'vet',
    phone: '0473821741'
  }
];

const USER_ROLE = {
  client: { user: 'CLIENT', compte: 'CLIENT' },
  admin: { user: 'ADMIN', compte: 'ADMIN' },
  vet: { user: 'VETERINAIRE', compte: 'VET' }
};

function parseProperties(filePath) {
  const raw = fs.readFileSync(filePath, 'utf8');
  const out = {};
  for (const line of raw.split(/\r?\n/)) {
    const t = line.trim();
    if (!t || t.startsWith('#') || !t.includes('=')) {
      continue;
    }
    const idx = t.indexOf('=');
    out[t.slice(0, idx).trim()] = t.slice(idx + 1).trim();
  }
  return out;
}

function pick(arr) {
  return arr[Math.floor(Math.random() * arr.length)];
}

function randomPastDate(days = 30) {
  const d = new Date();
  d.setDate(d.getDate() - Math.floor(Math.random() * days));
  d.setHours(8 + Math.floor(Math.random() * 12), Math.floor(Math.random() * 60), Math.floor(Math.random() * 60), 0);
  return d;
}

function safeEnumRole(roleType) {
  return USER_ROLE[roleType] || USER_ROLE.client;
}

async function getCount(conn, table) {
  const [rows] = await conn.query(`SELECT COUNT(*) AS c FROM \`${table}\``);
  return Number(rows[0].c);
}

async function maybeInsert(conn, table, fn) {
  const count = await getCount(conn, table);
  if (count >= MAX_ROWS_PER_TABLE) {
    return false;
  }
  await fn();
  return true;
}

async function main() {
  const props = parseProperties(APP_PROPS);
  const conn = await mysql.createConnection({
    host: props['db.host'],
    port: Number(props['db.port'] || 3306),
    user: props['db.user'],
    password: props['db.password'],
    database: props['db.name']
  });

  const created = {};

  try {
    await conn.beginTransaction();

    const userIds = {};
    const compteIds = {};

    for (const u of REAL_USERS) {
      const role = safeEnumRole(u.roleType);
      const avatarPath = path.join(AVATAR_BASE, `${u.key}.jpeg`);

      const [found] = await conn.query('SELECT id FROM user WHERE LOWER(email) = LOWER(?) LIMIT 1', [u.email]);
      if (found.length > 0) {
        const userId = Number(found[0].id);
        await conn.query(
          `UPDATE user
           SET first_name = ?, last_name = ?, email = ?, password = ?, phone = ?, address = ?, city = ?, role = ?, active = 1, name = ?, profile_image_path = ?
           WHERE id = ?`,
          [
            u.firstName,
            u.lastName,
            u.email,
            u.password,
            u.phone,
            'Tunis',
            'Tunis',
            role.user,
            `${u.firstName} ${u.lastName}`,
            avatarPath,
            userId
          ]
        );
        userIds[u.key] = userId;
      } else {
        const [inserted] = await conn.query(
          `INSERT INTO user
           (first_name, last_name, email, password, phone, address, city, role, active, created_at, name, profile_image_path)
           VALUES (?, ?, ?, ?, ?, ?, ?, ?, 1, NOW(), ?, ?)`,
          [u.firstName, u.lastName, u.email, u.password, u.phone, 'Tunis', 'Tunis', role.user, `${u.firstName} ${u.lastName}`, avatarPath]
        );
        userIds[u.key] = Number(inserted.insertId);
      }
    }
    created.user = Object.keys(userIds).length;

    for (const u of REAL_USERS) {
      const role = safeEnumRole(u.roleType);
      const userId = userIds[u.key];
      const baseUsername = u.key;

      const [existing] = await conn.query('SELECT id_compte FROM compte WHERE user_id = ? LIMIT 1', [userId]);
      if (existing.length > 0) {
        const compteId = Number(existing[0].id_compte);
        await conn.query(
          'UPDATE compte SET username = ?, password = ?, role = ?, status = ? WHERE id_compte = ?',
          [baseUsername, u.password, role.compte, 'ACTIVE', compteId]
        );
        compteIds[u.key] = compteId;
      } else {
        let username = baseUsername;
        let suffix = 1;
        while (true) {
          const [used] = await conn.query('SELECT 1 FROM compte WHERE LOWER(username) = LOWER(?) LIMIT 1', [username]);
          if (used.length === 0) {
            break;
          }
          suffix += 1;
          username = `${baseUsername}${suffix}`;
        }

        if (await maybeInsert(conn, 'compte', async () => {
          const [result] = await conn.query(
            'INSERT INTO compte (user_id, username, password, role, status) VALUES (?, ?, ?, ?, ?)',
            [userId, username, u.password, role.compte, 'ACTIVE']
          );
          compteIds[u.key] = Number(result.insertId);
        })) {
          continue;
        }
      }
    }
    created.compte = await getCount(conn, 'compte');

    const realKeys = REAL_USERS.map((u) => u.key);
    const friendPairs = [
      ['saf', 'hamza'], ['saf', 'zak'], ['saf', 'youssef'], ['saf', 'djo'], ['saf', 'ilef'],
      ['hamza', 'zak'], ['hamza', 'youssef'], ['zak', 'djo'], ['youssef', 'djo'], ['djo', 'ilef']
    ];

    for (const [a, b] of friendPairs) {
      const senderId = userIds[a];
      const receiverId = userIds[b];
      if (!senderId || !receiverId) {
        continue;
      }

      const [reqExists] = await conn.query(
        'SELECT id FROM friend_request WHERE sender_id = ? AND receiver_id = ? LIMIT 1',
        [senderId, receiverId]
      );
      if (reqExists.length > 0) {
        await conn.query('UPDATE friend_request SET status = ? WHERE id = ?', ['ACCEPTED', reqExists[0].id]);
      } else {
        await maybeInsert(conn, 'friend_request', async () => {
          await conn.query(
            'INSERT INTO friend_request (sender_id, receiver_id, status, created_at) VALUES (?, ?, ?, ?)',
            [senderId, receiverId, 'ACCEPTED', randomPastDate(60)]
          );
        });
      }

      const user1 = Math.min(senderId, receiverId);
      const user2 = Math.max(senderId, receiverId);
      const [friendExists] = await conn.query(
        'SELECT id FROM friendship WHERE user1_id = ? AND user2_id = ? LIMIT 1',
        [user1, user2]
      );
      if (friendExists.length === 0) {
        await maybeInsert(conn, 'friendship', async () => {
          await conn.query(
            'INSERT INTO friendship (user1_id, user2_id, created_at) VALUES (?, ?, ?)',
            [user1, user2, randomPastDate(60)]
          );
        });
      }
    }

    const clientIds = realKeys.filter((k) => safeEnumRole(REAL_USERS.find((u) => u.key === k).roleType).user === 'CLIENT').map((k) => userIds[k]);
    const adminIds = realKeys.filter((k) => safeEnumRole(REAL_USERS.find((u) => u.key === k).roleType).user === 'ADMIN').map((k) => userIds[k]);
    const vetIds = realKeys.filter((k) => safeEnumRole(REAL_USERS.find((u) => u.key === k).roleType).user === 'VETERINAIRE').map((k) => userIds[k]);

    const animalNames = ['Nala', 'Milo', 'Luna', 'Rocky', 'Bella', 'Leo', 'Simba', 'Max'];
    for (let i = 0; i < 8; i += 1) {
      await maybeInsert(conn, 'animal', async () => {
        const ownerKey = pick(['saf', 'youssef', 'djo']);
        await conn.query(
          `INSERT INTO animal (name, species, breed, age, gender, description, status, image, owner_compte_id)
           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)`,
          [
            animalNames[i],
            i % 2 === 0 ? 'Dog' : 'Cat',
            i % 2 === 0 ? 'Labrador' : 'Siamese',
            1 + (i % 6),
            i % 2 === 0 ? 'MALE' : 'FEMALE',
            `Custom seeded pet ${animalNames[i]}`,
            i % 5 === 0 ? 'ADOPTED' : 'AVAILABLE',
            `seed_animal_${i + 1}.jpg`,
            compteIds[ownerKey] || null
          ]
        );
      });
    }

    const [animalRows] = await conn.query('SELECT idAnimal FROM animal ORDER BY idAnimal DESC LIMIT 10');
    const animalIds = animalRows.map((r) => Number(r.idAnimal));

    const postCaptions = [
      'First walk of the day with my pet.',
      'Healthy breakfast for my companion.',
      'Adoption weekend update from FurHope.',
      'Vet check completed and all good.',
      'Sharing tips about grooming routines.',
      'Our rescue journey continues.',
      'New toy, happy mood.',
      'Training progress this week.',
      'Park time with friends.',
      'Photo diary from today.'
    ];

    for (let i = 0; i < postCaptions.length; i += 1) {
      await maybeInsert(conn, 'post', async () => {
        await conn.query(
          `INSERT INTO post (author_id, caption, media_type, visibility, status, created_at)
           VALUES (?, ?, 'NONE', 'PUBLIC', 'ACTIVE', ?)`,
          [pick(Object.values(userIds)), postCaptions[i], randomPastDate(45)]
        );
      });
    }

    const [postRows] = await conn.query('SELECT id, author_id FROM post ORDER BY id DESC LIMIT 10');
    const postIds = postRows.map((p) => Number(p.id));

    for (let i = 0; i < 8; i += 1) {
      await maybeInsert(conn, 'comment', async () => {
        const post = pick(postRows);
        await conn.query(
          `INSERT INTO comment (post_id, author_id, body, status, created_at)
           VALUES (?, ?, ?, 'ACTIVE', ?)`,
          [post.id, pick(Object.values(userIds)), `Custom comment ${i + 1}`, randomPastDate(30)]
        );
      });
    }

    const [commentRows] = await conn.query('SELECT id, post_id, author_id FROM comment ORDER BY id DESC LIMIT 10');

    for (let i = 0; i < 8; i += 1) {
      await maybeInsert(conn, 'comment_reaction', async () => {
        const c = pick(commentRows);
        const userId = pick(Object.values(userIds));
        const [exists] = await conn.query('SELECT 1 FROM comment_reaction WHERE comment_id = ? AND user_id = ? LIMIT 1', [c.id, userId]);
        if (exists.length === 0) {
          await conn.query('INSERT INTO comment_reaction (comment_id, user_id, reaction) VALUES (?, ?, ?)', [c.id, userId, 'LIKE']);
        }
      });
    }

    for (let i = 0; i < 6; i += 1) {
      await maybeInsert(conn, 'post_share', async () => {
        const postId = pick(postIds);
        const userId = pick(Object.values(userIds));
        const [exists] = await conn.query('SELECT 1 FROM post_share WHERE post_id = ? AND user_id = ? LIMIT 1', [postId, userId]);
        if (exists.length === 0) {
          await conn.query('INSERT INTO post_share (post_id, user_id, created_at) VALUES (?, ?, ?)', [postId, userId, randomPastDate(20)]);
        }
      });
    }

    for (let i = 0; i < 5; i += 1) {
      await maybeInsert(conn, 'post_report', async () => {
        const postId = pick(postIds);
        const userId = pick(Object.values(userIds));
        const [exists] = await conn.query('SELECT 1 FROM post_report WHERE post_id = ? AND reporter_user_id = ? LIMIT 1', [postId, userId]);
        if (exists.length === 0) {
          await conn.query('INSERT INTO post_report (post_id, reporter_user_id, reason, created_at) VALUES (?, ?, ?, ?)', [postId, userId, 'Spam', randomPastDate(15)]);
        }
      });
    }

    for (let i = 0; i < 8; i += 1) {
      await maybeInsert(conn, 'notification', async () => {
        const post = pick(postRows);
        const actor = pick(Object.values(userIds));
        const recipient = post.author_id === actor ? pick(clientIds) : post.author_id;
        await conn.query(
          `INSERT INTO notification (recipient_id, actor_id, type, post_id, comment_id, message, is_read, created_at)
           VALUES (?, ?, ?, ?, NULL, ?, ?, ?)`,
          [recipient, actor, 'POST_LIKE', post.id, 'custom seeded notification', i % 2, randomPastDate(20)]
        );
      });
    }

    for (let i = 0; i < 6; i += 1) {
      await maybeInsert(conn, 'produit', async () => {
        await conn.query(
          'INSERT INTO produit (title, price, tva, image, description, stock) VALUES (?, ?, ?, ?, ?, ?)',
          [`Seed Product ${i + 1}`, 10 + i * 3, 19, `seed_prod_${i + 1}.jpg`, 'Custom seeded product', 20 + i * 2]
        );
      });
    }
    const [productRows] = await conn.query('SELECT id, title, price, tva FROM produit ORDER BY id DESC LIMIT 10');

    for (let i = 0; i < 6; i += 1) {
      await maybeInsert(conn, 'panier', async () => {
        const p = pick(productRows);
        const qty = 1 + (i % 3);
        const totalT = Number((Number(p.price) * qty * (1 + Number(p.tva) / 100)).toFixed(2));
        await conn.query(
          'INSERT INTO panier (idProduit, title, totalP, totalt, qty, client_id) VALUES (?, ?, ?, ?, ?, ?)',
          [p.id, p.title, Number(p.price), totalT, qty, pick(clientIds)]
        );
      });
    }

    for (let i = 0; i < 4; i += 1) {
      await maybeInsert(conn, 'promo_codes', async () => {
        const expiry = new Date();
        expiry.setDate(expiry.getDate() + 20 + i * 10);
        await conn.query(
          'INSERT INTO promo_codes (code, discount_percent, expiration_date, usage_limit, used_count) VALUES (?, ?, ?, ?, ?)',
          [`SEED${100 + i}`, 5 + i * 2, expiry, 50, i]
        );
      });
    }

    for (let i = 0; i < 4; i += 1) {
      await maybeInsert(conn, 'adoptionrequest', async () => {
        await conn.query(
          `INSERT INTO adoptionrequest (animal_id, client_compte_id, message, phone, address, status, created_at)
           VALUES (?, ?, ?, ?, ?, ?, ?)`,
          [pick(animalIds), compteIds[pick(['saf', 'youssef', 'djo'])], 'Custom adoption request', '20101010', 'Tunis', i % 2 === 0 ? 'PENDING' : 'APPROVED', randomPastDate(25)]
        );
      });
    }

    for (let i = 0; i < 4; i += 1) {
      await maybeInsert(conn, 'adoption_request', async () => {
        await conn.query(
          'INSERT INTO adoption_request (request_date, status, animal_id, client_id) VALUES (?, ?, ?, ?)',
          [randomPastDate(20), i % 2 === 0 ? 'PENDING' : 'APPROVED', pick(animalIds), pick(clientIds)]
        );
      });
    }

    for (let i = 0; i < 4; i += 1) {
      await maybeInsert(conn, 'disponibilite', async () => {
        await conn.query(
          'INSERT INTO disponibilite (vet_id, start_time, end_time, is_available) VALUES (?, ?, ?, ?)',
          [pick(vetIds), `${String(9 + i).padStart(2, '0')}:00:00`, `${String(10 + i).padStart(2, '0')}:30:00`, 1]
        );
      });
    }

    const [dispoRows] = await conn.query('SELECT id_disponibilite FROM disponibilite ORDER BY id_disponibilite DESC LIMIT 10');
    const dispoIds = dispoRows.map((d) => Number(d.id_disponibilite));

    for (let i = 0; i < 4; i += 1) {
      await maybeInsert(conn, 'rendezvous', async () => {
        const d = new Date();
        d.setDate(d.getDate() + i + 1);
        await conn.query(
          `INSERT INTO rendezvous (appointment_date, appointment_time, status, description, client_id, vet_id, animal_id, disponibilite_id)
           VALUES (?, ?, ?, ?, ?, ?, ?, ?)`,
          [d.toISOString().slice(0, 10), `${String(10 + i).padStart(2, '0')}:00:00`, 'pending', 'Custom seeded rendezvous', pick(clientIds), pick(vetIds), pick(animalIds), pick(dispoIds)]
        );
      });
    }

    const [rdvRows] = await conn.query('SELECT id_rdv FROM rendezvous ORDER BY id_rdv DESC LIMIT 10');
    const rdvIds = rdvRows.map((r) => Number(r.id_rdv));

    for (let i = 0; i < 3; i += 1) {
      await maybeInsert(conn, 'review', async () => {
        await conn.query(
          'INSERT INTO review (client_id, vet_id, rdv_id, rating, commentaire, created_at) VALUES (?, ?, ?, ?, ?, ?)',
          [pick(clientIds), pick(vetIds), pick(rdvIds), 4 + (i % 2), 'Custom seeded review', randomPastDate(10)]
        );
      });
    }

    for (let i = 0; i < 4; i += 1) {
      await maybeInsert(conn, 'reclamation', async () => {
        await conn.query(
          'INSERT INTO reclamation (client_id, sujet, description, status, created_at) VALUES (?, ?, ?, ?, ?)',
          [pick(clientIds), `Custom issue ${i + 1}`, 'Custom seeded complaint', 'OPEN', randomPastDate(20)]
        );
      });
    }
    const [reclamRows] = await conn.query('SELECT id FROM reclamation ORDER BY id DESC LIMIT 10');
    const reclamIds = reclamRows.map((r) => Number(r.id));

    for (let i = 0; i < 4; i += 1) {
      await maybeInsert(conn, 'reponse', async () => {
        await conn.query(
          'INSERT INTO reponse (reclamation_id, admin_id, message, created_at, sender_id, sender_type, rating) VALUES (?, ?, ?, ?, ?, ?, ?)',
          [pick(reclamIds), pick(adminIds), 'Custom seeded reply', randomPastDate(10), pick(adminIds), 'ADMIN', 4]
        );
      });
    }

    await conn.query(
      `UPDATE post p
       LEFT JOIN (
         SELECT post_id,
                SUM(CASE WHEN reaction='LIKE' THEN 1 ELSE 0 END) AS likes_count,
                SUM(CASE WHEN reaction='DISLIKE' THEN 1 ELSE 0 END) AS dislikes_count
         FROM post_reaction
         GROUP BY post_id
       ) r ON r.post_id = p.id
       LEFT JOIN (
         SELECT post_id, COUNT(*) AS comments_count
         FROM comment
         GROUP BY post_id
       ) c ON c.post_id = p.id
       LEFT JOIN (
         SELECT post_id, COUNT(*) AS shares_count
         FROM post_share
         GROUP BY post_id
       ) s ON s.post_id = p.id
       SET p.likes_count = COALESCE(r.likes_count,0),
           p.dislikes_count = COALESCE(r.dislikes_count,0),
           p.comments_count = COALESCE(c.comments_count,0),
           p.shares_count = COALESCE(s.shares_count,0)`
    );

    await conn.commit();

    const tablesToReport = [
      'user', 'compte', 'post', 'post_reaction', 'comment', 'comment_reaction',
      'notification', 'friend_request', 'friendship', 'animal',
      'adoptionrequest', 'adoption_request', 'produit', 'panier',
      'promo_codes', 'disponibilite', 'rendezvous', 'review', 'reclamation', 'reponse'
    ];
    for (const table of tablesToReport) {
      created[table] = await getCount(conn, table);
    }
    console.log('seed done');
    for (const [k, v] of Object.entries(created)) {
      console.log(`${k}: ${v}`);
    }
  } catch (error) {
    await conn.rollback();
    console.error(error.message);
    process.exitCode = 1;
  } finally {
    await conn.end();
  }
}

main();
