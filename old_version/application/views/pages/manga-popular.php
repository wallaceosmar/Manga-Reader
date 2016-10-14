<?php

/* 
 * Copyright (C) 2016 Wallace Osmar https://github.com/wallaceosmar.
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
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-lg-12" style="min-height: 200px;">
                            <div class="page-header" style="border-bottom:2px solid #efefef;">
                                <h1><?php _e('Lista de Mangas mais populares');?></h1>    
                            </div>
                            <?php if( count( $listManga ) > 0 ):?>
                            <ul class="manga-list">
                                <?php foreach( (array) $listManga as $manga ):?>
                                <li>
                                    <a class="manga-list-img" href="<?php echo base_url("/manga/{$manga->slug}");?>" rel="15291">
                                        <div style="float:left;overflow:hidden">
                                            <img src="<?php echo base_url("/image/compressed/{$manga->slug}/cover.jpg?w=100&h=142");?>" />
                                        </div>
                                    </a>
                                    <div class="manga-list-text">
                                        <a class="title" href="<?php echo base_url("/manga/{$manga->slug}");?>" rel="15291"><?php echo $manga->title;?></a>
                                        <p class="info"> <?php echo sprintf( __('%d vizualizações') , $manga->views )?></p>
                                    </div>
                                </li>
                                <?php endforeach;?>
                            </ul>
                            <?php else:?>
                            <div>
                                <p><?php _e('Não ha nenhum manga popular.');?></p>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if( isset ( $pagination ) && $pagination->enable ):?>
                    <div class="row">
                        <div class="col-lg-12">
                            <nav style="text-align: center;">
                                <ul class="pagination">
                                    <?php if(($pagination->currentPage+1) == $pagination->preview ): ?>
                                    <li class="disabled">
                                        <span aria-hidden="true">&laquo;</span>
                                    </li>
                                    <?php else:?>
                                    <li>
                                        <a href="<?php echo base_url( sprintf( $pagination->url , $pagination->preview ) );?>" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <?php endif;?>
                                    <?php for( $i = $pagination->beginFor; $i < $pagination->endFor+1; $i++ ):?>
                                    <li><a href="<?php echo base_url( sprintf( $pagination->url , $i ) );?>"><?php echo $i;?></a></li>
                                    <?php endfor;?>
                                    <?php if(($pagination->currentPage+1) == $pagination->next):?>
                                    <li class="disabled">
                                        <span aria-hidden="true">&raquo;</span>
                                    </li>
                                    <?php else:?>
                                    <li>
                                        <a href="<?php echo base_url( sprintf( $pagination->url , $pagination->next ) );?>" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                    <?php endif;?>
                                </ul>
                            </nav>
                            
                        </div>
                    </div>
                    <?php endif;?>
                </div>
            </div>
