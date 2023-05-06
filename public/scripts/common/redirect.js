const myLocation = window.location.host;
setTimeout(() => {
    window.location = `http://${myLocation}`;
}, 3000);
