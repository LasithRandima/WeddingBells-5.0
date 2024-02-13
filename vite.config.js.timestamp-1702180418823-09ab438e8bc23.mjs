// vite.config.js
import { defineConfig } from "file:///F:/dev/Wedding-Bells-4.0/node_modules/vite/dist/node/index.js";
import laravel, { refreshPaths } from "file:///F:/dev/Wedding-Bells-4.0/node_modules/laravel-vite-plugin/dist/index.mjs";
var vite_config_default = defineConfig({
  plugins: [
    laravel({
      input: [
        "resources/css/app.css",
        "resources/js/app.js",
        "resources/css/filament/admin/theme.css",
        "resources/css/filament/merchants/theme.css"
      ],
      refresh: [
        ...refreshPaths,
        "app/Livewire/**",
        "app/Http/Livewire/**",
        "app/Forms/Components/**",
        "app/Filament/Merchants/Resources/**/**",
        "app/Filament/Merchants/Resources/**"
      ]
    })
  ],
  resolve: {
    alias: {
      "@": "/resources/js"
    }
  },
  refresh: true
});
export {
  vite_config_default as default
};
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcuanMiXSwKICAic291cmNlc0NvbnRlbnQiOiBbImNvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9kaXJuYW1lID0gXCJGOlxcXFxkZXZcXFxcV2VkZGluZy1CZWxscy00LjBcIjtjb25zdCBfX3ZpdGVfaW5qZWN0ZWRfb3JpZ2luYWxfZmlsZW5hbWUgPSBcIkY6XFxcXGRldlxcXFxXZWRkaW5nLUJlbGxzLTQuMFxcXFx2aXRlLmNvbmZpZy5qc1wiO2NvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9pbXBvcnRfbWV0YV91cmwgPSBcImZpbGU6Ly8vRjovZGV2L1dlZGRpbmctQmVsbHMtNC4wL3ZpdGUuY29uZmlnLmpzXCI7aW1wb3J0IHsgZGVmaW5lQ29uZmlnIH0gZnJvbSAndml0ZSdcbmltcG9ydCBsYXJhdmVsLCB7IHJlZnJlc2hQYXRocyB9IGZyb20gJ2xhcmF2ZWwtdml0ZS1wbHVnaW4nXG5cbmV4cG9ydCBkZWZhdWx0IGRlZmluZUNvbmZpZyh7XG4gICAgcGx1Z2luczogW1xuICAgICAgICBsYXJhdmVsKHtcbiAgICAgICAgICAgIGlucHV0OiBbXG4gICAgICAgICAgICAgICAgJ3Jlc291cmNlcy9jc3MvYXBwLmNzcycsXG4gICAgICAgICAgICAgICAgJ3Jlc291cmNlcy9qcy9hcHAuanMnLFxuICAgICAgICAgICAgICAgICdyZXNvdXJjZXMvY3NzL2ZpbGFtZW50L2FkbWluL3RoZW1lLmNzcycsXG4gICAgICAgICAgICAgICAgJ3Jlc291cmNlcy9jc3MvZmlsYW1lbnQvbWVyY2hhbnRzL3RoZW1lLmNzcycsXG4gICAgICAgICAgICBdLFxuICAgICAgICAgICAgcmVmcmVzaDogW1xuICAgICAgICAgICAgICAgIC4uLnJlZnJlc2hQYXRocyxcbiAgICAgICAgICAgICAgICAnYXBwL0xpdmV3aXJlLyoqJyxcbiAgICAgICAgICAgICAgICAnYXBwL0h0dHAvTGl2ZXdpcmUvKionLFxuICAgICAgICAgICAgICAgICdhcHAvRm9ybXMvQ29tcG9uZW50cy8qKicsXG4gICAgICAgICAgICAgICAgJ2FwcC9GaWxhbWVudC9NZXJjaGFudHMvUmVzb3VyY2VzLyoqLyoqJyxcbiAgICAgICAgICAgICAgICAnYXBwL0ZpbGFtZW50L01lcmNoYW50cy9SZXNvdXJjZXMvKionLFxuICAgICAgICAgICAgXSxcbiAgICAgICAgfSksXG4gICAgXSxcblxuICAgIHJlc29sdmU6IHtcbiAgICAgICAgYWxpYXM6IHtcbiAgICAgICAgICAgICdAJzogJy9yZXNvdXJjZXMvanMnLFxuICAgICAgICB9LFxuICAgIH0sXG4gICAgcmVmcmVzaDogdHJ1ZSxcblxufSlcbiJdLAogICJtYXBwaW5ncyI6ICI7QUFBZ1EsU0FBUyxvQkFBb0I7QUFDN1IsT0FBTyxXQUFXLG9CQUFvQjtBQUV0QyxJQUFPLHNCQUFRLGFBQWE7QUFBQSxFQUN4QixTQUFTO0FBQUEsSUFDTCxRQUFRO0FBQUEsTUFDSixPQUFPO0FBQUEsUUFDSDtBQUFBLFFBQ0E7QUFBQSxRQUNBO0FBQUEsUUFDQTtBQUFBLE1BQ0o7QUFBQSxNQUNBLFNBQVM7QUFBQSxRQUNMLEdBQUc7QUFBQSxRQUNIO0FBQUEsUUFDQTtBQUFBLFFBQ0E7QUFBQSxRQUNBO0FBQUEsUUFDQTtBQUFBLE1BQ0o7QUFBQSxJQUNKLENBQUM7QUFBQSxFQUNMO0FBQUEsRUFFQSxTQUFTO0FBQUEsSUFDTCxPQUFPO0FBQUEsTUFDSCxLQUFLO0FBQUEsSUFDVDtBQUFBLEVBQ0o7QUFBQSxFQUNBLFNBQVM7QUFFYixDQUFDOyIsCiAgIm5hbWVzIjogW10KfQo=
