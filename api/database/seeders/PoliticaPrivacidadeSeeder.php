<?php

namespace Database\Seeders;

use App\Models\PoliticaPrivacidade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PoliticaPrivacidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $versoes = ['1.0'];

        foreach ($versoes as $versao) {
            $registroEXistente = PoliticaPrivacidade::where('versao', $versao)->first();

            if (!$registroEXistente) {
                PoliticaPrivacidade::create([
                    'versao' => $versao,
                    'conteudo' => '<h2>1. Introdução</h2><p>A presente Política de Privacidade descreve como o aplicativo <strong>Mútua</strong> coleta, utiliza, armazena e protege os dados pessoais de seus usuários.</p><p>O Mútua é uma plataforma voltada à conexão entre pessoas por meio de serviços de interesse social e comunitário. Entre as funcionalidades disponíveis atualmente e as que poderão ser disponibilizadas futuramente estão módulos como doações, pessoas desaparecidas, animais desaparecidos, adoção de animais e outros serviços relacionados aos objetivos da plataforma.</p><p>Ao utilizar o aplicativo, o usuário declara estar ciente desta Política de Privacidade.</p><hr><h2>2. Dados coletados</h2><p>Para possibilitar o funcionamento da plataforma, poderão ser coletados os seguintes dados:</p><ul><li>Nome de usuário;</li><li>Endereço de e-mail;</li><li>Telefone para contato;</li><li>Chave Pix informada voluntariamente pelo usuário;</li><li>Endereço informado pelo usuário;</li><li>Coordenadas geográficas (latitude e longitude) associadas ao endereço cadastrado;</li><li>Informações relacionadas aos anúncios, publicações e demais conteúdos cadastrados pelo usuário na plataforma.</li></ul><p>O aplicativo não coleta dados além daqueles necessários ao seu funcionamento.</p><hr><h2>3. Finalidade da coleta</h2><p>Os dados são utilizados para:</p><ul><li>Identificar os usuários da plataforma;</li><li>Permitir a utilização das funcionalidades disponibilizadas pelo Mútua;</li><li>Exibir conteúdos, anúncios e publicações em listas e mapas, quando aplicável;</li><li>Auxiliar a equipe responsável na intermediação entre usuários, quando necessário para o funcionamento da plataforma;</li><li>Manter o funcionamento, a integridade e a segurança dos serviços oferecidos;</li><li>Cumprir obrigações legais e regulatórias, quando aplicáveis.</li></ul><hr><h2>4. Compartilhamento de informações</h2><p>O Mútua poderá atuar como intermediador entre usuários nas funcionalidades em que essa abordagem for adotada, buscando preservar a privacidade e a segurança dos envolvidos.</p><p>Informações pessoais como telefone, endereço de e-mail, chave Pix e endereço completo não são disponibilizadas automaticamente para outros usuários da plataforma.</p><p>Quando necessário para a prestação de determinado serviço, a equipe responsável pelo Mútua poderá utilizar essas informações para realizar a intermediação entre as partes, sempre respeitando a finalidade para a qual os dados foram fornecidos.</p><p>O Mútua não comercializa dados pessoais nem os compartilha com terceiros para fins publicitários.</p><p>Os dados poderão ser compartilhados apenas quando houver obrigação legal ou determinação de autoridade competente.</p><hr><h2>5. Armazenamento e segurança</h2><p>São adotadas medidas técnicas e administrativas destinadas a proteger os dados pessoais contra acesso não autorizado, alteração, divulgação ou destruição.</p><p>Embora sejam empregados esforços para garantir a segurança das informações, nenhum sistema é completamente imune a riscos decorrentes do uso da internet.</p><hr><h2>6. Responsabilidade pelas informações</h2><p>O usuário é responsável pela veracidade dos dados fornecidos e pela atualização de suas informações sempre que necessário.</p><hr><h2>7. Direitos do usuário</h2><p>Nos termos da Lei Geral de Proteção de Dados (LGPD), o usuário poderá solicitar, quando aplicável:</p><ul><li>Acesso aos seus dados;</li><li>Correção de informações incorretas;</li><li>Atualização de dados;</li><li>Exclusão de sua conta e dos dados associados;</li><li>Informações sobre o tratamento de seus dados pessoais.</li></ul><hr><h2>8. Exclusão da conta</h2><p>O usuário poderá solicitar ou realizar a exclusão de sua conta por meio das funcionalidades disponibilizadas pelo aplicativo.</p><p>A exclusão poderá implicar na remoção permanente dos dados pessoais e dos conteúdos cadastrados pelo usuário na plataforma, ressalvadas as hipóteses em que a legislação exigir sua manutenção.</p><hr><h2>9. Alterações desta Política</h2><p>Esta Política de Privacidade poderá ser atualizada a qualquer momento para refletir melhorias no aplicativo, alterações legais ou mudanças na forma de tratamento dos dados.</p><p>A versão mais recente estará sempre disponível para consulta.</p><hr><h2>10. Contato</h2><p>Em caso de dúvidas sobre esta Política de Privacidade ou sobre o tratamento de dados pessoais, entre em contato pelos canais oficiais disponibilizados pelo Mútua.</p>',
                ]);
            }
        }
    }
}
