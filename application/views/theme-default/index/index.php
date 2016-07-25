<?php

/* 
 * The MIT License
 *
 * Copyright 2016 Wallace Osmar https://github.com/wallaceosmar.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

?>
            <div class="row" >
                <div class="col-sm-9">
                    <div class="row">
                        
                        <div class="col-lg-12">
                            <div class="page-header">
                                <h1 id="tables"><?php _e('20 ultimos mangas');?></h1>
                            </div>
                            <div class="bs-component live-less-editor-hovercontainer">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th colspan="2"><?php _e('Manga');?></th>
                                            <th><?php _e('Ultimo cápitulo');?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="background-image:url('<?php echo base_url('/image/compressed/douluo-daulo/cover.jpg?w=100&h=142');?>');width:100px;height:100%;background-size: 100px; background-position:50% 30%; cursor: hand; cursor: pointer;" onclick="window.location = '<?php echo base_url("/manga/doulou-dalu/");?>';"></td>
                                            <td>
                                                <h4>
                                                    <a href="<?php echo base_url('/manga/doulou-dalu/');?>">Doulou Dalu</a>
                                                </h4>
                                            </td>
                                            <td>0</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="col-lg-12">
                            
                            <div class="page-header">
                                <h1 id="tables"><?php _e('50 ultimos mangas atualizados.');?></h1>
                            </div>
                            <div>
                                <div>
                                    <span data-toggle="mangapop" manga-slug="doulou-dalu" data-placement="right" data-original-title="Doulou Dalu (2011)" class="manga-2">
                                        <b><a href="<?php echo base_url('/manga/doulou-dalu/');?>">Doulou Dalu</a></b>
                                    </span>
                                    <span class="pull-right">
                                        <i><time class="timeago" datetime="2016-07-04 18:32:22"></time></i>
                                    </span>
                                    <br />
                                </div>

                            </div>
                        </div>
                        
                    </div>
                </div>
                
                <div class="col-sm-3">
                    <h3><?php _e('Mangas mais populares.');?></h3>
                    <hr class="manga-hr">
                    
                    <span class="thumbnail" data-toggle="mangapop" data-placement="left" manga-slug="doulou-dalu" data-original-title="Doulou Dalu (2011)" style="padding: 10px; margin: 3px">
                        <div class="media">
                            <a class="pull-left" href="<?php echo base_url('/manga/doulou-dalu/');?>">
                                <img class="media-object img-thumb" src="<?php echo base_url('/image/compressed/douluo-daulo/cover.jpg?w=100&h=142');?>" alt="doulou-dalu">
                            </a>
                            <div class="media-body">
                                <h3 class="media-heading" id="tables">
                                    <a href="<?php echo base_url('/manga/doulou-dalu/');?>">Doulou Dalu</a>
                                </h3>
                                <?php echo sprintf('Total de visualizações %s', 0);?><br>
                            </div>
                        </div>
                    </span>
                    
                </div>
                
            </div>