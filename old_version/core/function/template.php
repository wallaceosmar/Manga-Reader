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

// functions need
register_load_group_functions('hooks');

/**
 * Carrega todas as funçoes atribuidas para o cabecalho da pagina
 * 
 */
function template_header() {
    /**
     * 
     */
    do_action("register_header_template");
}

/**
 * Carrega todas as funçoes atribuidas para o rodape da pagina
 */
function template_footer() {
    /**
     * 
     */
    do_action("register_footer_template");
}

/**
 * 
 * @param type $function_to_add
 */
function register_template_section_header ( $function_to_add ) {
    /**
     * 
     */
    add_action( 'register_header_template', $function_to_add);
}

/**
 * 
 * @param type $function_to_add
 */
function register_template_section_footer ( $function_to_add ) {
    /**
     * 
     */
    add_action( 'register_footer_template', $function_to_add);
}