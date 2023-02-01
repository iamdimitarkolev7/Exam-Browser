function getCookie(name) {
  const value = `; ${document.cookie}`;
  const parts = value.split(`; ${name}=`);
  if (parts.length === 2) return parts.pop().split(';').shift();
}
  
function setCookie(name, value) {
  const cookie = `${name}=${value}`;
  document.cookie = cookie;
}