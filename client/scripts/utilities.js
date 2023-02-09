const sendHttpRequest = (method, url, data) => {
  const promise = new Promise((resolve, reject) => {
    const xhr = new XMLHttpRequest();
    xhr.open(method, url, true);

    xhr.responseType = 'json';

    if (data) {
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    }

    xhr.onload = () => {
      if (xhr.status >= 400) {
        reject(xhr.response);
      } else {
        resolve(xhr.response);
      }
    };

    xhr.onerror = () => {
      reject('Something went wrong!');
    };

    if (data) {
      console.log(data);
      console.log(Object.entries(data).map(([k,v])=>{return k+'='+v}).join('&'));
      xhr.send(Object.entries(data).map(([k,v])=>{return k+'='+v}).join('&'));
    } else {
      xhr.send();
    }
  });

  return promise;
};

const getData = (url) => {
  return sendHttpRequest('GET', url);
};

const sendData = (url, data) => {
  return sendHttpRequest('POST', url, data);
};
