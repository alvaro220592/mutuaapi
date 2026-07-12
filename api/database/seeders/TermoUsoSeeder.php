<?php

namespace Database\Seeders;

use App\Models\TermoUso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TermoUsoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $versoes = ['1.0'];

        foreach ($versoes as $versao) {
            $registroEXistente = TermoUso::where('versao', $versao)->first();

            if (!$registroEXistente) {
                TermoUso::create([
                    'versao' => $versao,
                    'conteudo' => '<h2>1. Objetivo</h2><p>O Mútua é uma plataforma destinada a facilitar iniciativas de interesse social e comunitário por meio de diferentes módulos, como doações, pessoas desaparecidas, animais desaparecidos, adoção de animais e outras funcionalidades que venham a ser disponibilizadas.</p><hr><h2>2. Cadastro</h2><p>O usuário declara que fornecerá informações verdadeiras e atualizadas durante o cadastro e será responsável pela segurança de sua conta e de suas credenciais de acesso.</p><hr><h2>3. Utilização da plataforma</h2><p>O usuário compromete-se a utilizar o Mútua de forma ética, respeitosa e em conformidade com a legislação brasileira.</p><p>Não é permitido utilizar a plataforma para:</p><ul><li>Divulgar informações falsas ou enganosas;</li><li>Aplicar golpes ou obter vantagens ilícitas;</li><li>Praticar assédio, ameaças, discriminação ou discurso de ódio;</li><li>Publicar conteúdos ilegais ou ofensivos;</li><li>Utilizar a plataforma para finalidades diversas daquelas propostas pelo Mútua.</li></ul><hr><h2>4. Responsabilidade do usuário</h2><p>Cada usuário é integralmente responsável pelas informações, publicações e conteúdos que cadastrar na plataforma, respondendo por sua veracidade e pelas consequências decorrentes de sua utilização.</p><hr><h2>5. Intermediação</h2><p>O Mútua poderá atuar como intermediador entre usuários em determinadas funcionalidades, buscando preservar a privacidade e a segurança dos envolvidos.</p><p>O contato direto entre usuários poderá ser limitado ou inexistente, conforme as regras de funcionamento de cada módulo da plataforma.</p><hr><h2>6. Moderação</h2><p>O Mútua poderá remover conteúdos, suspender funcionalidades ou encerrar contas que violem estes Termos de Uso ou a legislação vigente, independentemente de aviso prévio.</p><hr><h2>7. Limitação de responsabilidade</h2><p>O Mútua disponibiliza uma plataforma para facilitar iniciativas de interesse social, porém não garante o sucesso das interações realizadas por seus usuários, nem responde pela veracidade das informações publicadas por terceiros.</p><hr><h2>8. Encerramento da conta</h2><p>O usuário poderá solicitar a exclusão de sua conta a qualquer momento.</p><p>O Mútua também poderá encerrar contas que descumpram estes Termos de Uso.</p><hr><h2>9. Alterações destes Termos</h2><p>Estes Termos de Uso poderão ser alterados a qualquer momento para refletir mudanças na plataforma ou adequações legais. A versão mais recente permanecerá disponível para consulta.</p>',
                ]);
            }
        }
    }
}
