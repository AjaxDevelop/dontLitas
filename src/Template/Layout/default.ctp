<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'DontListas';

?>
<!DOCTYPE html>
<html>
    <head>
        <?= $this->Html->charset('utf-8') ?>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>
            <?= $cakeDescription ?>:
            <?= $this->fetch('title') ?>
        </title>
        <?= $this->Html->meta('icon') ?>

        <!-- Bootstrap CSS -->
        <?= $this->Html->css('bootstrap/bootstrap.min.css') ?>

        <!-- MdbFree CSS -->
        <?= $this->Html->css('mdbfree/mdb.min.css') ?>

        <!-- Configurações Globais CSS -->
        <?= $this->Html->css('global') ?>

        <!-- Jquery Javascript -->
        <?= $this->Html->script('jquery/jquery.min.js') ?>

        <!-- Popper Javascript -->
        <?= $this->Html->script('popper/popper.min.js') ?>

        <!-- Bootstrap Javascript -->
        <?= $this->Html->script('bootstrap/bootstrap.min.js') ?>

        <!-- MdbFree Javascript -->
        <?= $this->Html->script('mdbfree/mdb.min.css') ?>

        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
        <?= $this->fetch('script') ?>
    </head>
    <body>
        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="#">DontListas</a>
        </nav>
        <?= $this->Flash->render() ?>
        <div class="container clearfix wrapper">
            <?= $this->fetch('content') ?>
        </div>
        <!--Footer-->
        <footer class="page-footer font-small blue pt-4 mt-4">

            <!--Footer Links-->
            <div class="container-fluid text-center text-md-left">
                <div class="row">

                    <!--First column-->
                    <div class="col-md-6">
                        <h5 class="text-uppercase">DontListas</h5>
                        <p>Projeto inspirado no site 'dontpad.com', entretanto, apresentando como funcionalidade o gerenciamento de listas.</p>
                    </div>
                    <!--/.First column-->

                    <!--Second column-->
                    <div class="col-md-6">
                        <h5 class="text-uppercase">Links</h5>
                        <ul class="list-unstyled">
                            <li>
                                <a href="https://github.com/AjaxDevelop/dontLitas">Repositóriob</a>
                            </li>
                            <li>
                                <a href="#!">Sobre o Projeto</a>
                            </li>
                            <li>
                                <a href="https://github.com">GitHub</a>
                            </li>
                        </ul>
                    </div>
                    <!--/.Second column-->
                </div>
            </div>
            <!--/.Footer Links-->

            <!--Copyright-->
            <div class="footer-copyright py-3 text-center">
                © 2018 Copyright:
            </div>
            <!--/.Copyright-->

        </footer>
    </body>
</html>
