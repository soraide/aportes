$(function() {
  $('.material-card > .mc-btn-action').click(function () {
      var card = $(this).parent('.material-card');
      var icon = $(this).children('i');
      icon.addClass('fa-spin-fast');

      if (card.hasClass('mc-active')) {
          card.removeClass('mc-active');

          window.setTimeout(function() {
              icon
                  .removeClass('fa-arrow-left')
                  .removeClass('fa-spin-fast')
                  .addClass('fa-bars');

          }, 800);
      } else {
          card.addClass('mc-active');

          window.setTimeout(function() {
              icon
                  .removeClass('fa-bars')
                  .removeClass('fa-spin-fast')
                  .addClass('fa-arrow-left');

          }, 800);
      }
  });
});


// let url = "./data-user.json";
// let color = ["Red", "Pink"]

// fetch(url)
//     .then(response => response.json())
//     .then(data => showData(data))
//     .catch(error => console.log(error))
  
  
//   let showData = (data) => {
//     console.log(data)
//     console.log(data.length)

//     let body = "";
//     for ( let i=0; i<data.length; i++) {
//         console.log(data[i])
//         let color = ["Red", "Pink"]
//       body += `
        
//         <div class="col-md-4 col-sm-6 col-xs-12">
//             <article class="material-card ${color[i]}">
//                 <h2>
//                     <span>${data[i].name} ${data[i].last_name}</span>
//                     <strong>
//                         <i class="fa fa-fw fa-envelope"></i>
//                         ${data[i].email}
//                     </strong>
//                 </h2>
//                 <div class="mc-content">
//                     <div class="img-container">
//                         <img class="img-responsive" src=${data[i].img}>
//                     </div>
//                     <div class="mc-description">
//                         ${data[i].description}
//                     </div>
//                 </div>
//                 <a class="mc-btn-action">
//                     <i class="fa fa-bars"></i>
//                 </a>
//                 <div class="mc-footer">
//                     <h4>
//                         Contacto
//                     </h4>
//                     <!-- <a class="fa fa-fw fa-phone" href="432178907"></a> -->
//                     <a class="fa fa-fw fa-envelope" href="mailto: alfredo1234@gmail.com"></a>
//                     <h4 id="phone">Telefono: ${data[i].phone}</h4>
//                     <!-- <a class="fa fa-fw fa-twitter"></a>
//                     <a class="fa fa-fw fa-linkedin"></a>
//                     <a class="fa fa-fw fa-google-plus"></a> -->
//                 </div>
//             </article>
//         </div>

//       `
  
//     };
  
//     document.getElementById("users-profile").innerHTML = body;
  
//   }