import preset from './vendor/filament/support/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './resources/views/**/*.blade.php',
        './resources/js/**/*{.js,.ts,.vue}',
        './app/Filament/**/*.php',
        './vendor/filament/**/*.blade.php',
    ],
}
