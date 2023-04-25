//if browser support service worker

if('serviceWorker' in navigator) {

    navigator.serviceWorker.register('sw.js',{ scope: '/?page=' })
        .then(function (registration)
        {
            console.log('Service worker registered successfully');
        }).catch(function (e)
        {
            console.error('Error during service worker registration:', e);
        });
};