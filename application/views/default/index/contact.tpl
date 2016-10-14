{include file='_share/header.tpl'}
            <div class="row">
                
                <div class="col-sm-12">
                    <div class="row">
                        
                        <div class="container-fluid">
                            
                            <div class="page-header">
                                <h1>{'Contato'|__}</h1>
                            </div>
                            <p>{'Para entrar em contato conosco basta prencher o formulario abaixo ou enviar um email para <a href="mailto:%1$s">%1$s</a>.'|__|sprintf:$mailto}</p>
                            <div>
                                <h3>{'Formulario para contato'|__}</h3>
                                <p class="required small">* = {'Campos requiridos.'|__}</p>
                                <!--begin HTML Form-->
                                <form class="form-horizontal" role="form" method="post">
                                    
                                    <div class="form-group">
                                        <label for="name" class="col-sm-3 control-label"><span class="required">*</span> {'Nome'|__}: </label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="First &amp; Last">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="email" class="col-sm-3 control-label"><span class="required">*</span> E-Mail: </label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="contato@example.com">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="assunto" class="col-sm-3 control-label"><span class="required">*</span> {'Assunto'} </label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="you@domain.com">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="message" class="col-sm-3 control-label"><span class="required">*</span> {'Menssagem'}:</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control no-resize" rows="7" name="message" placeholder="Tell us your story?"></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-6 col-sm-offset-3">
                                            <button type="submit" id="submit" name="submit" class="btn btn-primary btn-block">{'Enviar'|__}</button>
                                        </div>
                                    </div>
                                    <!--end Form-->
                                </form>
                                
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
                
            </div>
{include file='_share/footer.tpl'}