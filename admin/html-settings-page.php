<?php
/**
 * This file contains the HTML form for the plugin
 *
 * @since     0.1.0
 * @author    Ricardo Lobo <tchabs@gmail.com>
 * @version   0.1.1
 */
if (! defined('ABSPATH')) exit;
?>

<div class="wrap dekatrian">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

    <h2 class="nav-tab-wrapper">
        <a href="#settings-tab" class="nav-tab nav-tab-active">Configurações</a>
        <a href="#help-tab" class="nav-tab">Ajuda</a>
        <a href="#about-tab" class="nav-tab">Sobre</a>
    </h2>

    <form action="options.php" method="post">

        <?php settings_fields($this->option_name); ?>

        <div id="settings-tab" class="section active">
            <table class="form-table">
                <?php do_settings_fields($this->page, 'dktn_basic_section'); ?>
            </table>

            <table class="form-table page_type">
                <?php do_settings_fields($this->page, 'dktn_gregorian_type_section'); ?>
            </table>
        </div>

        <div id="about-tab" class="section">
            <div class="header"><img src="<?php  echo DEKATRIAN_URL; ?>/admin/img/dekatrian.jpg"></div>
            <p>O <strong><a href="http://dekatrian.com">Calendário Dekatrian</a></strong> é uma proposta criada pelo <strong><a href="https://twitter.com/Peninha_13">Roberto "Pena" Spinelli</a></strong> como uma opção planejada ao caótico <a href="https://pt.wikipedia.org/wiki/Calend%C3%A1rio_gregoriano">Calendário gregoriano</a>, que apesar de diversas modificações e "correções" ainda remete ao <a href="https://pt.wikipedia.org/wiki/Calend%C3%A1rio_romano">Calendário Romano</a>.</p>
            <p>Muito se evoluiu desde o Calendário Romano, passamos de adicionar um mês a cada 2 anos (Mercedonius o mês intercalar) para 1 dia a cada 4 anos (29 de Fevereiro dos anos bissextos), mas durante o processo foram sendo acumulandos resquícios históricos que hoje já não fazem sentido, como o mês "Dezembro" que remete a época que os anos possuíam apenas 10 meses e que hoje é o mês 12, ou os meses <i>Julho</i> e <i>Agosto</i> que foram rebatizado em homenagem aos imperadores <i>Julius Caesar</i> e <i>Augusto</i> perdendo seu sentido original, entre outros.<br>
            Além das nomeclaturas ainda existem as irregularidades dos ciclos, com os meses não tendo a mesma quantidade de dias e semanas não se encaixando dentro dos meses.</p>
            <p>Para começar solucinar esses problemas foi proposto o <strong>Dekatrian</strong>, um novo calendário que foi desenvolvido para trazer um pouco de ordem ao caos.</p>
            <hr/>
            <p>Para saber mais, acesse o post <a href="http://www.deviante.com.br/noticias/dekatrian-um-calendario-minimamente-decente/">Dekatrian – Um calendário minimamente decente</a> onde o Pena explica sobre a criação do calendário e para entender o funcionamento dos cliclos veja <a href="http://www.deviante.com.br/noticias/desafios-de-um-calendario-os-ciclos/">Desafios de um calendário: Os ciclos</a>.</p>

            <p>Ouça o <a href="http://www.deviante.com.br/podcasts/scicast/106-tempo/">Scicast #106: Tempo</a> para saber sobre outras formas de medições de tempo.</p>

            <p><strong>"Não meçam o tempo com uma regua torta."</strong> <small>PENA, Roberto. Scicast #106: Tempo (65 min.)</small></p>
        </div>

        <div id="help-tab" class="section">
            <div id="mw-content-text" lang="en" dir="ltr" class="mw-content-ltr">
                <h2><span class="mw-headline" id="Personalizando_Data_e_Hora">Personalizando Data</span></h2>
                <p>O formato da data permite determinar como a data vai ser exibida. A seqüência de formato é um modelo em que várias partes da data são combinadas (usando os "caracteres de formato") para gerar uma data no formato especificado.</p>
                <p>Por exemplo, o formato:</p>
                <pre>j F Y</pre>
                <p>cria uma data como:</p>
                <pre>8 Lunan 2017</pre>
                <p>Aqui está o que cada caractere de string de formatação acima representa:</p>
                <ul>
                    <li> <code>j</code> = Dia do Mês.</li>
                    <li> <code>F</code> = Nome completo do mês.</li>
                    <li> <code>Y</code> = Ano no formato de 4 dígitos.</li>
                </ul>
                <p>Aqui está uma tabela dos itens aceitos:</p>
                
                <table width="80%" style="margin-bottom:1.5em;" class="widefat">
                    <tbody>
                        <tr>
                            <th style="background:#eee" colspan="3">Dia do Mês</th>
                        </tr>
                        <tr>
                            <td>d</td>
                            <td>Numérico, com zeros</td>
                            <td>01–31</td>
                        </tr>
                        <tr>
                            <td>j</td>
                            <td>Numérico, sem zeros</td>
                            <td>1–31</td>
                        </tr>
                        <tr>
                            <th style="background:#eee" colspan="3">Mês</th>
                        </tr>
                        <tr>
                            <td>m</td>
                            <td>Numérico, com zeros</td>
                            <td>01–12</td>
                        </tr>
                        <tr>
                            <td>n</td>
                            <td>Numérico, sem zeros</td>
                            <td>1–12</td></tr>
                            <tr><td>F</td>
                            <td>Completo em texto</td>
                            <td>Aurorian – Nixian (Anachronian, Sinchronian)</td></tr>
                        <tr>
                            <td>M</td>
                            <td>Três letras</td>
                            <td>Aur – Nix</td>
                        </tr>
                        <tr>
                            <th style="background:#eee" colspan="3">Ano</th>
                        </tr>
                        <tr>
                            <td>Y</td>
                            <td>Numérico, 4 dígitos</td>
                            <td>Ex.: 1999, 2003</td>
                        </tr>
                        <tr>
                            <td>y</td>
                            <td>Numérico, 2 dígitos</td>
                            <td>Ex.: 99, 03</td>
                        </tr>
                        <tr>
                            <th style="background:#eee" colspan="3">Casos especiais</th>
                        </tr>
                        <tr>
                            <td>G</td>
                            <td>Data em formato gregoriano<br><small>O formato é determinado nas configurações do Wordpress</small></td>
                            <td>Ex.: 26/10/2017</td>
                        </tr>
                        <tr>
                            <td>?</td>
                            <td>Exibição condicional em dias "Fora do tempo"<br><small>Ignora um caractere nos dias "Fora do tempo", por exemplo, não exibir o número do dia junto com os nomes <strong>Anachronian</strong> ou <strong>Sinchronian</strong></small></td>
                            <td>Ex.: Anachronian 2017</td>
                        </tr>
                    </tbody>
                </table>

                <h3><span class="mw-headline" id="Examplos">Exemplos</span></h3>
                <p>Alguns exemplos de formatação de data.</p>
                <ul>
                    <li><code>?d F Y</code> - Anachronian 2017</li>
                    <li><code>j F Y</code> - 2 Sinchronian 2016</li>
                    <li><code>d\m\Y</code> - 02\00\2016</li>
                    <li><code>d\m\Y (G)</code> - 18\11\2017 (26/10/2017)</li>
                </ul>
            </div>
        </div>

        <?php submit_button(); ?>

    </form>
</div>