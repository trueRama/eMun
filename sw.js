const CACHE_NAME = 'cool-cache';

importScripts('https://storage.googleapis.com/workbox-cdn/releases/5.1.2/workbox-sw.js');

// TODO: replace the following with the correct offline fallback page i.e.: const offlineFallbackPage = "offline.html";
const offlineFallbackPage = "Offline.html";

// Add whichever assets you want to pre-cache here:
const PRECACHE_ASSETS = [
    '/uploads/'
]

self.addEventListener("message", (event) => {
    if (event.data && event.data.type === "SKIP_WAITING") {
        self.skipWaiting();
    }
});

// Listener for the install event - pre-caches our assets list on service worker install.
self.addEventListener('install', event => {
    event.waitUntil((async () => {
        const cache = await caches.open(CACHE_NAME);
        cache.addAll(PRECACHE_ASSETS);
    })());
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

self.addEventListener('activate', event => {
    event.waitUntil(clients.claim());
});

//pre cache
// self.addEventListener('fetch', event => {
//   event.respondWith(async () => {
//     const cache = await caches.open(CACHE_NAME);
//
//     // match the request to our cache
//     const cachedResponse = await cache.match(event.request);
//
//     // check if we got a valid response
//     if (cachedResponse !== undefined) {
//       // Cache hit, return the resource
//       return cachedResponse;
//     } else {
//       // Otherwise, go to the network
//       return fetch(event.request)
//     };
//   });
// });
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