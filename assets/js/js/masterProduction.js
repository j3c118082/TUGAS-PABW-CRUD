function productsData(){
    $.ajax({
        url: '../../xml/masterDataProduksi.xml',
        dataType: 'xml',

        error: function () {
            $('#table tbody').append('<tr id="status"><td colspan="7" class="text-center">Can not load data</td></tr>'); 
        },
        
        success: function (response) {
            var products = $(response).find('dataBarang').children('barang');
            
            var i;

            for (i=0; i < products.length; i++){
                
                var data = products[i];
                
                var kode = $(data).children('kode').text();
                var nama = $(data).children('nama').text();
                var kategori = $(data).children('kategori').text();
                var batas = $(data).children('batas').text();
                var stok = $(data).children('stok').text();
                var status = $(data).children('status').text();
                                            
                $('#table tbody').append('<tr id="status">'+
                '<td>' + (i+1) + '</td>' +
                '<td>' + kode + '</td>' +
                '<td>' + nama + '</td>' +
                '<td>' + kategori + '</td>' +
                '<td>' + batas + '</td>' +
                '<td>' + stok + '</td>' +
                '<td>' + status + '</td>'
                );		
                
            }
        },
       
    })
};    



function time(){
    var t = new Date().toLocaleString();
    $('#timenow').html(t);
    setInterval(time, 1000);
}

function maintenance(){
    $(document).ready(function(){
   
        $('#maintenance').load('../../Error/main.html');
     
     });
}

