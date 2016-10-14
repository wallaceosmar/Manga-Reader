{include file='_share/header.tpl'}
            <div class="row" >
                <div class="col-sm-9">
                    
                    <div class="row">
                        
                        <div class="container-fluid" >
                            <div class = "page-header">
                                <h1>{'Login'|__}</h1>
                            </div>
                            
                            <form data-form="login" onsubmit="return false;" action="{'/auth/login'|base_url}" method="post">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 form-control-label">{'Usuario'|__}</label>
                                    <div class="col-sm-10">
                                        <input name="username" type="text" class="form-control" placeholder="{'Usuario'|__}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 form-control-label">{'Senha'|__}</label>
                                    <div class="col-sm-10">
                                        <input name="userpassword" type="password" class="form-control" id="inputPassword3" placeholder="{'Senha'|__}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-success">{'Logar'|__}</button>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                        
                    </div>
                </div>
                
                <div class="col-sm-3">
                    <div class="row"></div>
                </div>
                
            </div>
{include file='_share/footer.tpl'}