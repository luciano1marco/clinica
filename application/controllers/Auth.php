<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $auth_mode= array(0 => 'LDAP', 1 =>'BANCO');
        $this->lang->load('auth');
        $this->auth_mode = $auth_mode[1];
	}

	function index()
	{
        if ( ! $this->ion_auth->logged_in())
        {die;
            redirect('auth/login', 'refresh');
        }
        else
        {
            redirect('/', 'refresh');
        }
	}

    function login()
	{
        if ( ! $this->ion_auth->logged_in())
        {
            /* Load */
            $this->load->config('admin/dp_config');
            $this->load->config('common/dp_config');

            /* Valid form */
            $this->form_validation->set_rules('identity', 'Identity', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            /* Data */
            $this->data['title']               = $this->config->item('title');
            $this->data['title_lg']            = $this->config->item('title_lg');
            $this->data['auth_social_network'] = $this->config->item('auth_social_network');
            $this->data['forgot_password']     = $this->config->item('forgot_password');
            $this->data['new_membership']      = $this->config->item('new_membership');

            if ($this->form_validation->run() == TRUE) {
                if($this->auth_mode == 'LDAP'){
                 /* COMECO LDAP LOGIN */ 
                                 
                    $login = explode("@", $this->input->post("identity"));
                    $login = $login[0];
                    $password = $this->input->post("password");
                    $ldap_val = false;

                    $user = R::find("users", "username = '{$login}' AND active = 1");
                    if (count($user) > 0) {
                        $user = array_pop($user);
                        $conexao = ldap_connect("ldap://192.168.0.18", 389);
                        ldap_set_option($conexao, LDAP_OPT_PROTOCOL_VERSION, 3);
                        ldap_set_option($conexao, LDAP_OPT_REFERRALS, 0);
                        $ldap_val = @ldap_bind($conexao, "uid=" . $login . ",ou=usuarios,dc=riogrande,dc=local", $password);
                        ldap_close($conexao);
                    }

                    $remember = (bool) $this->input->post('remember');

                    if ($ldap_val) {
                        $this->ion_auth->set_session($user);
                        $this->ion_auth->update_last_login($user->id);

                        redirect('admin');
                    } else {
                        $this->session->set_flashdata('message', "Usuário e/ou senha incorretos");
                        redirect('auth/login', 'refresh');
                    }
                }
                /* FIM LDAP LOGIN */
                else{                
                    // NO LDAP
                    $remember = (bool) $this->input->post('remember');

                    if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
                    {
                        if ( ! $this->ion_auth->is_admin())
                        {
                            $this->session->set_flashdata('message', $this->ion_auth->messages());
                            redirect('/', 'refresh');
                        }
                        else
                        {
                            // Data 
                            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

                            // Load Template 
                            //$this->template->auth_render('auth/choice', $this->data);

                            redirect('admin');
                        }
                    }
                    else
                    {
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                    redirect('auth/login', 'refresh');
                    }
                }
            }
            /* FIM FORM VALIDATION */
            else
            {
                $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

                $this->data['auth_mode'] = $this->auth_mode;
                
                if($this->auth_mode == 'LDAP'){                    
                    $this->data['identity'] = array(
                        'name'        => 'identity',
                        'id'          => 'identity',                       
                        'type'        => 'text',
                        'value'       => $this->form_validation->set_value('identity'),
                        'class'       => 'form-control',
                        'placeholder' => lang('auth_your_email')
                    );
                }
                else{
                    $this->data['identity'] = array(
                        'name'        => 'identity',
                        'id'          => 'identity',
                        'type'        => 'email',                       
                        'value'       => $this->form_validation->set_value('identity'),
                        'class'       => 'form-control',
                        'placeholder' => lang('auth_your_email')
                    );
                }
                $this->data['password'] = array(
                    'name'        => 'password',
                    'id'          => 'password',
                    'type'        => 'password',
                    'class'       => 'form-control',
                    'placeholder' => lang('auth_your_password')
                );

                /* Load Template */
                $this->template->auth_render('auth/login', $this->data);
            }
        }
        else
        {
            redirect('/', 'refresh');
        }
   }


    function logout($src = NULL)
	{
        $logout = $this->ion_auth->logout();

        $this->session->set_flashdata('message', $this->ion_auth->messages());

        if ($src == 'admin')
        {
            redirect('/', 'refresh');
        }
        else
        {
            redirect('/', 'refresh');
        }
	}

    function esqueciminhasenha(){
        /* Load */
        $this->load->config('common/dp_config');

       
        if (count($this->input->post()) > 0) {
            $username = $this->input->post("email");

            $existe = R::find('users', "email = '{$username}'");

            if (count($existe) == 1) {
                $usuario = array_pop($existe);
                $id = $usuario->id;
                //cria uma nova senha
                $novasenha = $this->geraNovaSenha();
                //chama o id do email enviado
                $altsenha = R::load("users",$id);
                //pega a nova senha gerada                
                $altsenha->senha = md5($novasenha); 
                
                //grava no banco a nova senha
                R::store($altsenha);
               //envia email 
                $this->configEmail();
                $this->email->from('luciano1marco@gmail.com');
                $this->email->to($this->input->post("email"));

                //$this->email->to("matheus.cezar@riogrande.rs.gov.br");
                $this->email->subject('Clinica - Nova Senha');
                $corpoemail = "
                            Olá!<br /><br />
                            Sua senha foi alterada!<br /><br />
                            Para acessar o sistema utilize seu e-mail e a senha abaixo:<br />
                            {$novasenha}<br /><br />
                            Att.";
                $this->email->message($corpoemail);
                $this->email->send();
            }
            
            $this->data['message'] = "<p class='alert alert-success'>Tudo certo! Se seu e-mail está cadastrado, lhe encaminhamos uma mensagem com uma nova senha temporaria. Click em cancelar para voltar </p>";
            //redirect('./home//', 'refresh');
           
        } else {
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');  
        }

        $this->data['email'] = array(
            'name'        => 'email',
            'id'          => 'email',
            'type'        => 'text',
            'value'       => $this->form_validation->set_value('email'),
            'class'       => 'form-control',
            'placeholder' => "Digite seu e-mail aqui",
            'required' => 'required'
        );

        /* Load Template */
        $this->template->auth_render('auth/esqueciminhasenha', $this->data);
   //     $this->template->admin_render($this->anchor . '/auth/esqueciminhasenha', $this->data);

    }

    private function geraNovaSenha() {
        $caracteres = 'abcdefghijklmnopqrstuvwxyz12345678901234567890';
        $senha = array(); 
        $tamLista = strlen($caracteres) - 1; 
        for ($i = 0; $i < 8; $i++) {
            $c = rand(0, $tamLista);
            $senha[] = $caracteres[$c];
        }
        return implode($senha);
    }
    private function configEmail() {
        $this->load->library('email');
        $config['mailtype'] = 'html';
        $config['protocol'] = 'smtp';
        $config['smtp_crypto'] = 'ssl';
        $config['smtp_host'] = 'mail.riogrande.rs.gov.br';
        $config['smtp_user'] = 'no-reply@riogrande.rs.gov.br';
        $config['smtp_pass'] = 'd3vn0reply!';
        $config['smtp_port'] = '465';
        $this->email->initialize($config);
    }

}
