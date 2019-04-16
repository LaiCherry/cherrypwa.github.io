var installPromptEvent;
var staticCacheName = "pwa-blog";
var filesToCache = [
    '/css/app.css',
    '/js/app.js',
    '/manifest.json',
    '/js/pwa.js',
    '/images/icons/icon-72x72.png',
    '/images/icons/icon-96x96.png',
    '/images/icons/icon-128x128.png',
    '/images/icons/icon-144x144.png',
    '/images/icons/icon-152x152.png',
    '/images/icons/icon-192x192.png',
    '/images/icons/icon-384x384.png',
    '/images/icons/icon-512x512.png',
];

// Cache on install
self.addEventListener("install", event => {
    console.log("install");
    this.skipWaiting();
    event.waitUntil(
        caches.open(staticCacheName)
            .then(cache => {
                return cache.addAll(filesToCache);
            })
    )
});

// Clear cache on activate
self.addEventListener('activate', event => {
    console.log("activate");
    event.waitUntil(
        caches.keys().then(function(cacheNames){
            return Promise.all(
                cacheNames
                    .filter(function(cacheName){
                        console.log(cacheName);
                    })
                    .map(function(cacheName){
                        return caches.delete(cacheName)
                    })
            )
        })
    )
    /*event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames
                    .filter(cacheName => (cacheName.startsWith("pwa-")))
                    .filter(cacheName => (cacheName !== staticCacheName))
                    .map(cacheName => caches.delete(cacheName))
            );
        })
    );*/
});

// Serve from Cache
self.addEventListener("fetch", event => {
    console.log("fetch");
    event.respondWith(
        caches.match(event.request)
            .then(response => {
                return response || fetch(event.request);
            })
            .catch(() => {
                return caches.match('offline');
            })
    )
});
/*
self.addEventListener('beforeinstallprompt', (event) => {
    alert("beforeinstallprompt");
    // Prevent Chrome <= 67 from automatically showing the prompt
    event.preventDefault();
    // Stash the event so it can be triggered later.
    installPromptEvent = event;
    // Update the install UI to notify the user app can be installed
    //document.querySelector('#btnaddtoscreen').disabled = false;
    setTimeout(function() {
        // 如果 Chrome 版本是 67（含）以下，可以直接呼叫
        if (version <= 67) {
            installPromptEvent.prompt();
            return;
        }
  
        // 否則的話必須透過 user action 主動觸發
        // 這邊幫 #root 加上 event listener，代表點擊螢幕任何一處都會顯示 prompt
        document.querySelector('#btnaddtoscreen').addEventListener('click', addToHomeScreen);    
    }, showTime);
});

function addToHomeScreen(e) {
    console.log("123456");
    if (installPromptEvent) {
        installPromptEvent.prompt();
        installPromptEvent = null;
        document.querySelector('#btnaddtoscreen').removeEventListener('click', addToHomeScreen); 
    }
}
*/