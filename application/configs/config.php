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

//
add_menu('navbar-right', sprintf( '<i class="fa fa-sign-in"></i>  %s' , __('Login')), base_url('/login'));
add_menu('navbar-right', sprintf( '<i class="fa fa-user"></i>  %s', __('Registrar-se')), base_url('/register'));

// 
add_navbar( __('Home'), base_url( '/' ));
// Criando menu Read Manga
$readManga = add_navbar( __('Ler Manga'), base_url('#'));
$readManga->add( __('Lista de manga'), base_url('/pages/manga-list'));
$readManga->add( __('Mangas populares'), base_url('/pages/manga-popular'));
$readManga->add( __('Recentemente Atualizado'), base_url('/pages/recent-updates'));

add_menu('bottom-link', __('Contato'), base_url('/contact'));