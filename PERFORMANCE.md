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
- Resize or filter uploaded images before displaying them, and keep runtime uploads out of version control.
- Profile slow pages with the Symfony profiler in `dev`, then move back to `prod` for speed testing.
