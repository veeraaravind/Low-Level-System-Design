let currentTry = 0;
const maxTry = 3;
let lastCallTime = new Date();
const throttleDuration = 10000; // 10 seconds
const intervalTime = 100; // Milliseconds

function hitAPI() {
    const now = new Date();
    if (currentTry < maxTry && (now - lastCallTime) < throttleDuration) {
        console.log('IN');
        currentTry += 1;
        lastCallTime = now;
    } else {
        clearInterval(interval);
    }
}

let interval = setInterval(hitAPI, intervalTime);
