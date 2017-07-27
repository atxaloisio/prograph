/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
    //a url deve conter o protocolo.
    var urlBase = "http://larashop.localhost";
    var urlJson = "/upload";
    var urlJsonImagem = "/produtoimagem";
    var urlImagem = "/public/imagens";
    var txttag = "";
    var token = "";
    var ContadorCelula = 0;

    $('#btn_Buscar').click(function () {
        var codProduto = $('#txt_codigo_produto').val();

        //$('#txt_descricao_produto').val(urlBase + urlJson + '/' + codProduto);        
        $('#testediv').html("");
        //$('#testediv').hide();
        $.get(urlBase + urlJsonImagem, function (data) {
            token = data.token;
        });

        $.get(urlBase + urlJson + '/' + codProduto, function (data) {
            //success data            
            $('#txt_descricao_produto').val(data.nome);
            $('#txt_id_produto').val(data.id);

            //$('#testediv').val("<h1>teste</h1>");
            txttag = "";
            //$('#txt_descricao_produto').val(urlBase + urlJsonImagem + '/' + data.id);
            $.get(urlBase + urlJsonImagem + '/' + data.id, function (lstPrdImg) {
                //$('#txt_descricao_produto').val("");
                //$('#txt_descricao_produto').val(lstPrdImg[0].caminho);

                txttag = txttag + "<div class='panel panel-default'>" +
                        "<div class='panel-heading'>" +
                        "Imagens do Produto" +
                        "</div>" +
                        "<div class='panel-body'>" +
                        "<table class='table table-striped produto-table'>" +
                        "<thead>" +
                        "<th>Produto</th>" +
                        "</thead>" +
                        "<tbody>";

                for (i in lstPrdImg) {
                    txttag = txttag + "<tr>" +
                            "<td class='table-text'>" +
                            "<div>";

                    txttag = txttag + "<div class='wb_element' style='height: 180px; width: 33%;position: relative; float: left;'>" +
                            "<div>" +
                            "<center>" +
                            "<a href='loja/'>" +
                            "<img alt='destaque2' src='" +
                            urlBase + urlImagem + "/" + lstPrdImg[i].caminho + "' height='120px' widht='120px'" +
                            "</a>" +
                            "</center>" +
                            "</div>" +
                            "<div>" +
                            "<center>" +
                            "<form action='/produtoimagem/" + lstPrdImg[i].id + "' method='POST'>" +
                            //{{ csrf_field() }}
                            "<input type='hidden' name='_token' value='" + token + "'>" +
                            //{{ method_field('DELETE') }}
                            "<input type='hidden' name='_method' value='DELETE'>" +
                            "<button type='submit' id='delete-produto-imagem'" + lstPrdImg[i].id + "' class='btn btn-danger'>" +
                            "<i class='fa fa-btn fa-trash'></i>Excluir" +
                            "</button>" +
                            "</form>" +
                            "</center>" +
                            "</div>" +
                            "</div>";

                    txttag = txttag + "</div>" +
                            "</td>" +
                            "<td class='table-text'>" +
                            lstPrdImg[i].descicao +
                            "</td>" +
                            "</tr>";
                }
                ;

                //$('#txt_descricao_produto').val(txttag);
                $('#testediv').html(txttag);
            });
            $('#testediv').show();
        });
    });

    $('#btn_Buscar_img1').click(function () {
        $('#id_Img').val($('#txt_caminho_imagem1').attr('id'));
        //alert(img);
    });

    $('#btn_Buscar_img2').click(function () {
        $('#id_Img').val($('#txt_caminho_imagem2').attr('id'));
        //alert(img);
    });

    $('#btn_Buscar_img3').click(function () {
        $('#id_Img').val($('#txt_caminho_imagem3').attr('id'));
        //alert(img);
    });

    $('#btn_Buscar_img4').click(function () {
        $('#id_Img').val($('#txt_caminho_imagem4').attr('id'));
        //alert(img);
    });

    $('.imgclick').click(function () {
        var img = $('.imgclick').attr('src');
        $('#' + $('#id_Img').val()).val(img);
        //alert(img);
    });
});



function changeIt(img)
{
    var name = img.src;
    alert(name);
}

function isNumber(evt)
{
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode == 44)
    {
        return true;
    }
    else
    if ((charCode > 31 && charCode < 48) || charCode > 57) {
        return false;
    }
    return true;
}

$(function() {
  $("[autofocus]").on("focus", function() {
    if (this.setSelectionRange) {
      var len = this.value.length * 2;
      this.setSelectionRange(len, len);
    } else {
      this.value = this.value;
    }
    this.scrollTop = 999999;
  }).focus();
});
    