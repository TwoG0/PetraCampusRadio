var CACHE_STATIC_NAME = 'FILI-static-v1';  // Tambahkan versi agar mudah dikelola
var CACHE_DYNAMIC_NAME = 'FILI-dynamic-v1';  // Tambahkan versi agar mudah dikelola
var STATIC_FILES = [
  '/',  // Tambahkan lebih banyak file jika perlu
];

self.addEventListener('install', function(event) {
  console.log('[Service Worker] Installing Service Worker ...', event);
  event.waitUntil(
    caches.open(CACHE_STATIC_NAME)
      .then(function(cache) {
        console.log('[Service Worker] Precaching App Shell');
        return cache.addAll(STATIC_FILES);  // Pastikan semua file berhasil dicache
      })
  );
});

self.addEventListener('activate', function(event) {
  console.log('[Service Worker] Activating Service Worker ....', event);
  event.waitUntil(
    caches.keys()
      .then(function(keyList) {
        return Promise.all(keyList.map(function(key) {
          if (key !== CACHE_STATIC_NAME && key !== CACHE_DYNAMIC_NAME) {
            console.log('[Service Worker] Removing old cache.', key);
            return caches.delete(key);
          }
        }));
      })
  );
  return self.clients.claim();
});

self.addEventListener('fetch', function(event) {
  event.respondWith(
    caches.match(event.request).then(function(response) {
      if (response) {
        // Return cached response if found
        return response;
      } else {
        // Otherwise, fetch the resource from the network and cache it dynamically
        return fetch(event.request).then(function(res) {
          return caches.open(CACHE_DYNAMIC_NAME).then(function(cache) {
            // Only cache valid responses (status 200)
            if (res.status === 200) {
              cache.put(event.request.url, res.clone());
            }
            return res;
          });
        }).catch(function(err) {
          // Handle errors, optionally show fallback content
          console.error('[Service Worker] Fetch failed; returning offline page instead.', err);
        });
      }
    })
  );
});
