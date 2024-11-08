// (function ($) {
//     "use strict";
//     var TGNT = {};
//     const VDmessage = new VdMessage();

//     TGNT.listCollection = () => {
//         let abcc = "";
//         $.ajax({
//             type: "GET",
//             url: "/bo-suu-tap/list",
//             success: function (data) {
//                 data.forEach((element) => {
//                     abcc += `
//                    <div class="col-md-6 col-sm-12 mb-5">
//                         <div class="card card-blog">
//                             <div class="card-image">
//                                 <a href="#"> <img class="img card-image-top" src="${element.thumbnail}">
//                                 </a>
//                             </div>
//                             <div class="table mt-2 p-3">
//                                 <a href="#" class="card-caption">${element.name}</a>
//                                 <hr class="border-3 w-25 my-2">
//                                 <p class="card-description"> ${element.short_content} </p>
//                             </div>
//                         </div>
//                     </div>
//                     `;
//                 });
//                 $(".list").html(abcc);
//             },
//         });
//     };

//     $(document).ready(function () {
//         TGNT.listCollection();
//     });
// })(jQuery);
