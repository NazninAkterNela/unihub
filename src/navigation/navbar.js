
const anchors = document.querySelectorAll('.list-group-item');

anchors.forEach(anchor => {
    anchor.addEventListener('click', function(event) {
      event.preventDefault();
  
      // Remove active class from previously selected anchor
      //document.querySelector('.active').classList.remove('active');
      
      // Add active class to newly selected anchor
      this.classList.add('active');
      
      const id=anchor.getAttribute('id');

      console.log(id);

    if (id == 'search') {
      window.location.href = '../search/search_S.php';
    } else if (id == 'hire') {
      window.location.href = '../hire/hire_s.php';
    } else if (id == 'profile') {
      const user = document.querySelector('.user-type');
      const value = user.textContent;
      console.log(value);
      if (value == 'student') {
        window.location.href = '../profile/profile_student.php';
      } else if (value == 'faculty') {
        window.location.href = '../profile/profile_faculty.php';
      }

    } else if (id == 'home') {
      window.location.href = '../home/home.php';
    } else if (id == 'market') {
      window.location.href = '../market/market.php';
    } else if (id == 'course-list') {
      window.location.href = '../coursesinf/coursesinf.php';
    } else if (id == 'online-lecture') {
      window.location.href = '../online-lectures/lectures.php';
    }

  });
});
