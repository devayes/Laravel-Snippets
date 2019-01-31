### Install 
Create a routes file outside of your working app.

### Usage
In your .env add:
`EXTRA_ROUTES="/path/to/custom/routes.php"`

In your /routes/web.php add:
```
// Store these outside of the app to prevent commit
if (env('EXTRA_ROUTES') && file_exists(env('EXTRA_ROUTES'))) {
    @include(env('EXTRA_ROUTES'));
}
```
