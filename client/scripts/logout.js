const logout = (e) => {
  e.preventDefault();
    
  getData('../../server/controllers/logout.php')
  .then(response => {
    console.log(response);
    localStorage.clear();
    location.href = './index.php';
  })
  .catch(err => {
    console.log(err);
  });
};