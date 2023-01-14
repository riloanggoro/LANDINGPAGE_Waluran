/**
 * GET ARTICLE
 * ====================================
 */
 let arrayArticle   = [];
 const getAllArticle = async () => {
     $('#list-articles-spinner').removeClass('d-none'); 
     $('#list-articles-notfound').addClass('d-none'); 
     $('#table-articles').addClass('d-none');
 
     let httpResponse = await httpRequestGet(`${BASE_URL}/artikel`);
     
     $('#list-articles-spinner').addClass('d-none');
     
     if (httpResponse.status == 404) {
         arrayArticle = [];
         $('#list-articles-notfound').removeClass('d-none'); 
     }
     else if (httpResponse.status === 200) {
         let trKategori  = '';
         arrayArticle = httpResponse.data.data;
         $('#table-articles').removeClass('d-none');
  
         httpResponse.data.data.forEach((k,i)=> {
            let date      = new Date(parseInt(k.published_at) * 1000);
            let day       = date.toLocaleString("id-ID",{day: "2-digit"});
            let month     = date.toLocaleString("id-ID",{month: "long"});
            let year      = date.toLocaleString("id-ID",{year: "numeric"});
            let isPublish = new Date().getTime() >= date.getTime();
            console.log(date.getTime());

             trKategori  += `<tr class="text-xs">
                 <td class="align-middle text-center" style="max-width:40px;">
                     <span class="font-weight-bold"> ${++i} </span>
                 </td>
                 <td class="align-middle text-center py-3" style="max-width:100px;">
                     <img src="${k.thumbnail}" class="img-thumbnail" style="width:100px;height:100px;max-width:100px;max-height:100px;">
                 </td>
                 <td class="align-middle text-center">
                     ${k.title}
                 </td>
                 <td class="align-middle text-center">
                     ${k.kategori}
                 </td>
                 <td class="align-middle text-center ${(isPublish) ? "text-success" : "text-secondary"}">
                     <i class="${(isPublish) ? "bi bi-check-circle" : "bi bi-dash-circle"}" style="font-size:35px;"></i>
                 </td>
                 <td class="align-middle text-center">
                    ${month} ${day}, ${year}
                 </td>
                 <td class="align-middle text-center">
                     <a href='${BASE_URL}/dashboard/edit-artikel?id=${k.id}' class="btn btn-warning text-xxs">edit</a>
                     <a href='' id="${k.id}" class="btn btn-danger text-xxs" onclick="hapusArticle('${k.id}','${k.title}',event)">hapus</a>
                 </td>
              </tr>`;
         });
  
         $('#table-articles tbody').html(trKategori);
     }
 };
 getAllArticle();

 /**
  * DELETE ARTICLE
  * ====================================
  */
 const hapusArticle = (id,title,event) => {
     event.preventDefault();
 
     Swal.fire({
         title: 'ANDA YAKIN?',
         text: `artikel dengan judul '${title}' akan terhapus permanen`,
         icon: 'warning',
         showCancelButton: true,
         confirmButtonText: 'iya',
         showLoaderOnConfirm: true,
         preConfirm: async () => {
           let res = await httpRequestDelete(`${BASE_URL}/artikel/${id}`)
           if (res.status == 200) {
            getAllArticle();
           }
         },
         allowOutsideClick: () => !Swal.isLoading()
     })
 };