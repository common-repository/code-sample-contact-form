<?php
/*
* Format attribute for field 
*/
function format_atts($atts)
{
	$html = '';

	$prioritized_atts = array('type', 'name', 'value');

	foreach ($prioritized_atts as $att) {
		if (isset($atts[$att])) {
			$value = trim($atts[$att]);
			$html .= sprintf(' %s="%s"', $att, esc_attr($value));
			unset($atts[$att]);
		}
	}
    if(is_array($atts)) {
        foreach ($atts as $key => $value) {
            $key = strtolower(trim($key));
            
            if (!preg_match('/^[a-z_:][a-z_:.0-9-]*$/', $key)) {
                continue;
            }
            
            $value = trim($value);
            
            if ('' !== $value) {
                $html .= sprintf(' %s="%s"', $key, esc_attr($value));
            }
        }
    }
        
	$html = trim($html);

	return $html;
}

function parse_attr_to_array($str = '')
{
    parse_str(str_replace(',', '&', str_replace(':', '=', $str)), $attr);
    return $attr;

}

function upword_format($key)
{
    return ucwords(preg_replace('/-|_/', ' ', $key));
}