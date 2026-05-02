# Performance checklist

The app is configured for fast local rendering through `.env.local`:

```dotenv
APP_ENV=prod
APP_DEBUG=0
```

After changing code or templates in prod mode, warm the cache:

```bash
php bin/console cache:clear --env=prod --no-debug
php bin/console cache:warmup --env=prod --no-debug
php bin/console asset-map:compile --env=prod
```

For a realistic 1 second target:

- Keep Symfony in `prod` with debug disabled.
- Enable PHP OPcache in `php.ini`.
- Use the `public/.htaccess` rules with Apache so static files are cached and compressed.
- Resize or filter large uploaded images before displaying them. Current large examples include `public/uploads/animals/lovely-baby-2-weeks-thai-rabbit-9342e03cb1cb.jpg` at about 4 MB and `public/uploads/animals/orange-cat-in-cardboard-box-38bf54a019e1.png` at about 3 MB.
- Profile slow pages with the Symfony profiler in `dev`, then move back to `prod` for speed testing.
