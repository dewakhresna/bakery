// document.getElementById('image').addEventListener('change', function(event) {
//     const imagePreview = document.getElementById('imagePreview');
//     const file = event.target.files[0];

//     if (file) {
//       const reader = new FileReader();
//       reader.onload = function(e) {
//         imagePreview.innerHTML = `<img src="${e.target.result}" alt="Selected Image">`;
//       };
//       reader.readAsDataURL(file);
//     } else {
//       imagePreview.innerHTML = '<span>No Image</span>';
//     }
// });