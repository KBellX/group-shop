
export function getStorage(key) {
    return sessionStorage.getItem(key);
}

export function setStorage(key, value) {
    return sessionStorage.setItem(key, value);
}

export function removeStorage(key) {
    return sessionStorage.removeItem(key)
}
