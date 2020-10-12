function stokMaster(){
    $.ajax({
        url: '../../xml/stokMaster.xml',
        dataType: 'xml',

        error: function () {
            $('#stokMaster tbody').append('<tr id="status"><td colspan="7" class="text-center">Can not load data</td></tr>'); 
        },
        
        success: function (response) {
            var products = $(response).find('stokMaster').children('produk');
            
            var i;

            for (i=0; i < products.length; i++){
                
                var data = products[i];
                
                var nama = $(data).children('nama').text();
                var tanggal = $(data).children('tanggal').text();
                var grade = $(data).children('grade').text();
                var stok = $(data).children('stok').text();
                var satuan = $(data).children('satuan').text();
                                            
                $('#stokMaster tbody').append('<tr id="status">'+
                '<td>' + (i+1) + '</td>' +
                '<td>' + nama + '</td>' +
                '<td>' + tanggal + '</td>' +
                '<td>' + grade + '</td>' +
                '<td>' + stok + '</td>' +
                '<td>' + satuan + '</td>'
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

