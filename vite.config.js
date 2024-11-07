import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [vue()],
    build: {
      outDir: 'public/build',  // Compiled assets will be placed here
      manifest: true,  // Ensure manifest is created
      rollupOptions: {
        input: 'resources/js/app.js',
      },
    },
  });
  

