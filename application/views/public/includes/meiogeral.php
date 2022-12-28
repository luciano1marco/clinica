<style>
    #meiogeral {
        background-color: transparent;
       
    }
    #meiogeral h2{
        font-size: 20px;
        font-family: Georgia, 'Times New Roman', Times, serif;
        text-align: center;
        color: #407689;
       
    }
    #meiogeral textarea{
        font-size: 20px;
        font-family: Georgia, 'Times New Roman', Times, serif;
        text-align: center;
        color: #407689;
        
        background-color: #407689;
        color: #fff;
    }
    #meiogeral textarea:hover{
        background-color: #fff;
        color: #8bacb8ff;
    }
    #meiogeral h3{
        font-weight: bold;
        font-size: 24px;
        font-family: Georgia, 'Times New Roman', Times, serif;
        text-align: center;
        margin-top: 5px;
        color: #000;
    }
    #meiogeral h4{
        font-weight: bold;
        font-size: 36px;
        font-family: Georgia, 'Times New Roman', Times, serif;
        text-align: center;
        margin-top: 5px;
        color: #fff;
    }
    #meiogeral h6{
        font-weight: bold;
        font-size: 36px;
        font-family: Georgia, 'Times New Roman', Times, serif;
        text-align: center;
        margin-top: 5px;
        color: #000; 
    }
    #datatable{
        background-color: #123F60;
        color:#fff;
    }
   
    body{
        text-align: center;
       	padding: 0;
		font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
		font-size: 14px;
    }
    #calendar {
		max-width: 800px;
		margin: 0 auto;
	}
</style>

<section class="content-header">
    <?php $anchor = 'public/'.$this->router->class; ?>
</section>

<div id="meiogeral">
    <section class="container-fluid">
        <div class="jumbotron jumbotron-fluid">
            <div class="container text-white">
               
                <h4><strong>Profissionais de Psicologia</strong></h4>
                <br><br>
            
                <div class="row" >
                    <div class="col-sm-12">
                        <?php foreach ($dados as $da) : ?>
                            <div class="card bg-light mb-3">
                                <!--inicio do card1-->
                                <div class="card-body" style="border-radius: 3%;">
                                    <!--cabeçalho do cartão-->
                                    <div class="card-title ">
                                        <h6><?php echo $da['nome']; ?></h6>
                                    </div>
                                    <!--texto do cartão-->
                                    <div class="card-text ">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h3 ><?php echo $da['profissao']; ?> </h3>
                                            </div> 
                                        </div>    
                                    </div>
                                    <!--corpo do cartão-->
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-sm-3 "> 
                                            <?php $caminho= 'upload/fotos/'.$da['caminho']; ?>  
                                                <img src="<?php echo $caminho ;?>"  class=" img-fluid rounded-circle">
                                            </div>
                                            <div class="col-sm-9">
                                                <textarea rows= "10" cols="53" readonly><?php echo $da['descricao']; ?></textarea>
                                               
                                            </div> 
                                        </div>    
                                    </div>
                                    <!--rodape do cartão-->
                                    <div class="card-footer">
                                        <div class="text-center text-bold">
                                                <ul class="list-inline">
                                                    <li><a target="_blank" href="<?php echo $da['rede1']; ?>" class="facebook"> <i class="fa fa-facebook" > </i></a></li>
                                                    <li><a target="_blank" href="<?php echo $da['rede2']; ?>"  class="twitter">  <i class="fa fa-twitter" >  </i></a></li>
                                                    <li><a target="_blank" href="<?php echo $da['rede3']; ?>"  class="instagram"><i class="fa fa-instagram"> </i></a></li>
                                                    <li><a target="_blank" href="<?php echo $da['rede4']; ?>"  class="youtube">  <i class="fa fa-youtube" >  </i></a></li>
                                                </ul>
                                        </div>
                                    </div>
                                </div>
                                <!--fim do card1-->
                            </div>
                        <?php endforeach; ?>  
                    </div> 
                </div>
            </div>    
        </div>
    </section>

    <section class="container-fluid" id="sobre">
        <div class="jumbotron jumbotron-fluid">
            <div class="container text-white" >
                <h4><strong>Sobre</strong></h4>
                <p>Criado para atender os profissionais de psicologia, com um software integrado com as necessidades individuais de cada profissional. Com agenda interna e pessoal, cadastro de pacientes, Relatórios e outros.</p>
                <p></p>
                <p></p>
               
                 <!-- <p><strong>Contamos com a sua participação!</strong></p>-->
            </div>
        </div>
    </section>
</div>

<style>
.error{
    color: red;
}
</style>