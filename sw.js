// This is the service worker with the combined offline experience (Offline page + Offline copy of pages)
const CACHE = "pwabuilder-offline-page";

importScripts('https://storage.googleapis.com/workbox-cdn/releases/5.1.2/workbox-sw.js');

// TODO: replace the following with the correct offline fallback page i.e.: const offlineFallbackPage = "offline.html";
const offlineFallbackPage = "Offline.html";

self.addEventListener("message", (event) => {
    if (event.data && event.data.type === "SKIP_WAITING") {
        self.skipWaiting();
    }
});

self.addEventListener('install', async (event) => {
    event.waitUntil(
        caches.open(CACHE)
            .then((cache) => cache.add(offlineFallbackPage))
    );
});

if (workbox.navigationPreload.isSupported()) {
    workbox.navigationPreload.enable();
}

workbox.routing.registerRoute(
    new RegExp('/*'),
    new workbox.strategies.StaleWhileRevalidate({
        cacheName: CACHE
    })
);

self.addEventListener('fetch', (event) => {
    if (event.request.mode === 'navigate') {
        event.respondWith((async () => {
            try {
                const preloadResp = await event.preloadResponse;

                if (preloadResp) {
                    return preloadResp;
                }

                const networkResp = await fetch(event.request);
                return networkResp;
            } catch (error) {
                const cache = await caches.open(CACHE);
                const cachedResp = await cache.match(offlineFallbackPage);
                return cachedResp;
            }
        })());
    }
});

async function updateArticles() {
    const articlesCache = await caches.open(CACHE);
    await articlesCache.add(offlineFallbackPage);
}

self.addEventListener('periodicsync', (event) => {
    if (event.tag === 'update-articles') {
        event.waitUntil(updateArticles());
    }
});
// // On install - caching the application shell
// self.addEventListener('install', function(event) {
//   event.waitUntil(
//     caches.open('sw-cache').then(function(cache) {
//       // cache any static files that make up the application shell
//       return cache.add('/index.php');
//     })
//   );
// });
//
// // On network request
// self.addEventListener('fetch', function(event) {
//   event.respondWith(
//     // Try the cache
//     caches.match(event.request).then(function(response) {
//       //If response found return it, else fetch again
//       return response || fetch(event.request);
//     })
//   );
// });