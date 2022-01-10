<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('configuracao'))
{
	function configuracao(){
		//$data['title'] = 'Questionário Comunidade Escolar';
		$data['CHARSET'] = 'UTF-8';	
		//$data['CHARSET'] = 'ISO-8859-1';						
		$data['favicon'] = 'favicon.ico';
		//$data['description'] = 'PMRG - Superintendência de Tecnologia da Informação';
		//$data['copyright'] =  'PMRG - Superintendência de Tecnologia da Informação';
		//$data['author'] =  'PMRG - Superintendência de Tecnologia da Informação';

		$data['arq_css'] = null;
		$data['arq_js'] = null;
		
		$data['frameworks_dir'] = 'assets/frameworks';
		$data['plugins_dir'] = 'assets/plugins';

		$data['public_js'] = 'public/javascript';
		$data['public_css'] = 'public/css';
		$data['public_plugins'] = 'public/plugins';
		$data['public_images'] = 'public/images';
		
		$data['delimitador'] = ',';
		$data['fim'] = '';
								
		return $data;
	} 

	function configuracao_PHP(){		
		$charset = 'UTF-8';		
		//$charset = ''ISO-8859-1';
		ini_set('default_charset', $charset);
		setlocale(LC_ALL, 'pt_BR.' . $charset);
		header('Content-Type: text/html; charset=' . $charset, true);
		set_time_limit(0);
		date_default_timezone_set('America/Sao_Paulo');
	}

	function calendario_template_html(){
		$class = 'href="javascript:void(0);" data-days="{day}"';
		return
		'
        {table_open}<table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" class="calendar">{/table_open}

        {heading_row_start}<tr style="border:none;">{/heading_row_start}

        {heading_previous_cell}<th style="border:none;" class="padB"><a class="calnav" data-calvalue="{previous_url}" href="javascript:void(0);"><button type="button" id="prev" class="btn btn-primary"><i class="fa fa-arrow-left"></i></button></a></th>{/heading_previous_cell}
        {heading_title_cell}<th style="border:none;" colspan="{colspan}"><h2>{heading}</h2></th>{/heading_title_cell}
        {heading_next_cell}<th style="border:none;" class="padB"><a class="calnav" data-calvalue="{next_url}" href="javascript:void(0);"><button type="button" id="prev" class="btn btn-primary"><i class="fa fa-arrow-right"></i></button></a></th>{/heading_next_cell}

        {heading_row_end}</tr>{/heading_row_end}

        {week_row_start}<tr>{/week_row_start}
        {week_day_cell}<th>{week_day}</th>{/week_day_cell}
        {week_row_end}</tr>{/week_row_end}

        {cal_row_start}<tr>{/cal_row_start}
        {cal_cell_start}<td>{/cal_cell_start}
        {cal_cell_start_today}<td>{/cal_cell_start_today}
        {cal_cell_start_other}<td class="other-month">{/cal_cell_start_other}

        {cal_cell_content}<a ' . $class . '>{day}</a>{content}{/cal_cell_content}
        {cal_cell_content_today}<a ' . $class . '>{day}</a>{content}<div class="highlight"></div>{/cal_cell_content_today}

        {cal_cell_no_content}<a ' . $class . '>{day}</a>{/cal_cell_no_content}
        {cal_cell_no_content_today}<a ' . $class . '>{day}</a><div class="highlight"></div>{/cal_cell_no_content_today}

        {cal_cell_blank}&nbsp;{/cal_cell_blank}

        {cal_cell_other}{day}{/cal_cel_other}

        {cal_cell_end}</td>{/cal_cell_end}
        {cal_cell_end_today}</td>{/cal_cell_end_today}
        {cal_cell_end_other}</td>{/cal_cell_end_other}
        {cal_row_end}</tr>{/cal_row_end}

		{table_close}</table>{/table_close}';
	}

	function calendario_template_array(){
		$class = 'href="javascript:void(0);" data-days="{day}"';
		return
		array(     
			'table_open' => '<table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" class="calendar">',
			'heading_row_start' => '<tr style="border:none;">',
			'heading_previous_cell' => '<th style="border:none;" class="padB"><a class="calnav" data-calvalue="{previous_url}" href="javascript:void(0);"><i class="fa fa-chevron-left fa-fw"></i></a></th>',
			'heading_title_cell' => '<th style="border:none;" colspan="{colspan}"></th>',
			'heading_next_cell' => '<th style="border:none;" class="padB"><a class="calnav" data-calvalue="{next_url}" href="javascript:void(0);"><i class="fa fa-chevron-right fa-fw"></i></a></th>',
			'heading_row_end' => '</tr>',		
			'week_row_start' => '<tr>',
			'week_day_cell' => '<th>{week_day}</th>',
			'week_row_end' => '</tr>',
			'cal_row_start' => '<tr>',
			'cal_cell_start' => '<td>',
			'cal_cell_start_today' => '<td>',   
			'cal_cell_start_other' => '<td class="other-month">',  
			'cal_cell_content' => '<a ' . $class . '>{day}</a>{content}',
			'cal_cell_content_today' => '<a ' . $class . '>{day}</a>{content}<div class="highlight"></div>',
			'cal_cell_no_content' =>  '<a ' . $class . '>{day}</a>',
			'cal_cell_no_content_today' => '<a ' . $class . '>{day}</a>{content}<div class="highlight"></div>',
			'cal_cell_blank' => '&nbsp;',
			'cal_cell_other' => '{day}',
			'cal_cell_end' => '</td>',
			'cal_cell_end_today' =>  '</td>',
			'cal_cell_end_other'  =>  '</td>',
			'cal_row_end' => '</tr>',
			'table_close' => '</table'
			);
	}
	
}
