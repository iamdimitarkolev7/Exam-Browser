const logout = (e) => {
  e.preventDefault();
    
  getData('http://localhost:80/exam-browser-api/server/controllers/logout.php')
  .then(response => {
    console.log(response);
    localStorage.clear();
    location.href = './index.php';
  })
  .catch(err => {
    console.log(err);
  });
};