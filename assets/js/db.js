let db;
const STORE_HISTORIES = 'histories';
const STORE_LOCALS = 'locals';

if (!window.indexedDB) {
    window.alert("Your browser doesn't support a stable version of IndexedDB. Recently Played and Local Files feature will not be available. Please user another or update your Browser!");
} else {
    let DBOpenRequest = indexedDB.open("musification", 2);

    DBOpenRequest.onerror = function (event) {
        alert("Database error: " + event.target.errorCode);
    };

    DBOpenRequest.onsuccess = function () {
        db = DBOpenRequest.result;
    };

    DBOpenRequest.onupgradeneeded = function (event) {
        let db = event.target.result;
        if (!db.objectStoreNames.contains(STORE_HISTORIES)) {
            db.createObjectStore(STORE_HISTORIES, {keyPath: "id"}).createIndex('played_at', 'played_at', { unique: false });
        }
        if (!db.objectStoreNames.contains(STORE_LOCALS)) {
            db.createObjectStore(STORE_LOCALS, {autoIncrement: true});
        }

    }
}

function writeData(storeName, data) {
    if (db) {
        let tx = db.transaction([storeName], 'readwrite');
        let store = tx.objectStore(storeName);
        store.put(data);
        return tx.complete;
    }
}

function readData(storeName, id) {
    if (db) {
        let tx = db.transaction([storeName], 'readonly');
        let store = tx.objectStore(storeName);
        return store.get(id).result;
    }
}

function readAllData(storeName) {
    if (db) {
        let tx = db.transaction([storeName], 'readonly');
        let store = tx.objectStore(storeName);
        return store.getAll();
    }
}

function removeData(storeName, id) {
    if (db) {
        let tx = db.transaction([storeName], 'readwrite');
        let store = tx.objectStore(storeName);
        store.delete(id);
        return tx.complete;
    }
}

function removeAllData(storeName) {
    if (db) {
        let tx = db.transaction([storeName], 'readwrite');
        let store = tx.objectStore(storeName);
        store.clear();
        return tx.complete;
    }
}