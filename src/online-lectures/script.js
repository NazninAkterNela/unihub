function searchLectures() {
    // Get input element and filter value
    var input = document.getElementById("course-search");
    var filter = input.value.toUpperCase();
    
    // Get lecture elements
    var lectures = document.getElementsByClassName("lecture");
    
    // Loop through all lectures and hide/show them based on filter
    for (var i = 0; i < lectures.length; i++) {
      var course = lectures[i].getElementsByClassName("course")[0];
      if (course.innerHTML.toUpperCase().indexOf(filter) > -1) {
        lectures[i].style.display = "";
      } else {
        lectures[i].style.display = "none";
      }
    }
  }
  