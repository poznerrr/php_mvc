document.onload = function(){
    const myLocation = window.location.host;
    setTimeout( ()=>{window.location=`${myLocation}/`}, 5000 );
}