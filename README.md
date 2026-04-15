# phase2

Symfony application with multiple modules, including a social feed module extended with:
- `cmen/google-charts-bundle` for social analytics at `/dashboard/social`
- a local Python AI helper for social post moderation and caption suggestions

## Safe to Share

This project is safe to push to GitHub with the current changes:
- local cache and session files stay ignored through `/var/`
- Composer vendor files stay ignored through `/vendor/`
- local Composer helper data is ignored through `/.composer-home/`
- Python bytecode for the AI helper is ignored through `tools/social_ai/__pycache__/`

No machine-specific absolute paths are required in committed source files.

## Social Module Setup

PHP/Symfony side:
1. `composer install`
2. configure your local `.env.local`
3. run the Symfony app normally

Optional AI side for the social feed:
1. install Python 3.11+
2. run:
   `powershell -ExecutionPolicy Bypass -File tools\social_ai\start.ps1`

More details:
- [tools/social_ai/README.md](tools/social_ai/README.md)
- [SOCIAL_FEED_AI_AND_CHARTS_NOTES.txt](SOCIAL_FEED_AI_AND_CHARTS_NOTES.txt)

## Social Pages

- Feed: `/social`
- New post page: `/social/posts/new`
- Analytics page: `/dashboard/social`

## Notes For Teammates

- The Python AI helper is only for the social feed module.
- Other teammates can pull the repo and continue working on their own modules without changing their own code.
- If someone wants to test image moderation or caption suggestions in the social module, they should run the Python AI helper locally.
