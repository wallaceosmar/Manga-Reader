<?php

/* 
 * Copyright (C) 2016 Avell G1511 MAX
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

?>
            <div class="row" >
                <div class="col-sm-9">
                    
                    <div class="row">
                        
                        <div class="container-fluid" >
                            <div class = "page-header">
                                <h1>
                                    <?php _e('Login');?>
                                </h1>
                            </div>
                            
                            <form data-form="login" onsubmit="return false;" action="<?php echo base_url('/auth/login');?>" method="post">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 form-control-label"><?php _e('Usuario');?></label>
                                    <div class="col-sm-10">
                                        <input name="username" type="text" class="form-control" placeholder="<?php _e('Usuario');?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 form-control-label"><?php _e('Senha');?></label>
                                    <div class="col-sm-10">
                                        <input name="userpassword" type="password" class="form-control" id="inputPassword3" placeholder="<?php _e('Senha');?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-success"><?php _e('Logar');?></button>
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