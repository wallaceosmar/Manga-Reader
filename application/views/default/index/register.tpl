{include file='_share/header.tpl'}
            <div class="row" >
                <div class="col-sm-9">
                    <div class="row">
                        
                        <div class="container-fluid" >
                            <div class = "page-header">
                                <h1>
                                    {'Registrar-se'|__}
                                </h1>
                            </div>
                            
                            <form action="{'/auth/register'|base_url}" onsubmit="return false;" method="post">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 form-control-label">{'Usuario'|__}</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputUsername" placeholder="{'Usuario'|__}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 form-control-label">{'Email'|__}</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inputEmail3" placeholder="{'Email'|__}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 form-control-label">{'Confirmar Email'|__}</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inputEmail3" placeholder="{'Email'|__}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 form-control-label">{'Password'|__}</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="inputPassword3" placeholder="{'Password'||__}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 form-control-label">{'Confirmar Password'|__}</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="inputPassword3" placeholder="{'Password'|__}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-success">{'Registrar'|__}</button>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                        
                    </div>
                </div>
                
                <div class="col-sm-3">
                    <div class="row">
                    </div>
                </div>
                
            </div>
{include file='_share/footer.tpl'}