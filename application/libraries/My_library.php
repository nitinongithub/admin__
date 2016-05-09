<?php

class My_library {

    function heading_for_page($value_) {
        switch ($value_) {
            case 1:
                $data['tmp'] = 'About the '. _SCHOOL_;
                $data['keys_'] = 'Little, India, Academy, School, Sparkle, Little Sparkel Academy, Motahaldu, Haldwani';
                $data['desc_'] = 'Motive is to improve and maintain core academics in order to facilitate development of concepts and ideas within the young creative minds.';
                $data['pagename'] = 'About Us';
                $data['page_phrase'] = 'We are bound to maintain academics';
                $data['phrase_color'] = '#ffffff';
                break;
            case 2:
                $data['tmp'] = 'Admission in '. _SCHOOL_;
                $data['keys_'] = 'Little, India, Academy, School, Sparkle, Little Sparkel Academy, Motahaldu, Haldwani';
                $data['desc_'] = 'Motive is to improve and maintain core academics in order to facilitate development of concepts and ideas within the young creative minds.';
                $data['pagename'] = 'Admission';
                $data['page_phrase'] = 'We emphasize delivering quality';
                $data['phrase_color'] = '#ffffff';
                break;
            case 3:
                $data['tmp'] = 'Features of '. _SCHOOL_;
                $data['keys_'] = 'Little, India, Academy, School, Sparkle, Little Sparkel Academy, Motahaldu, Haldwani';
                $data['desc_'] = 'Motive is to improve and maintain core academics in order to facilitate development of concepts and ideas within the young creative minds.';
                $data['pagename'] = 'Features';
                $data['page_phrase'] = 'We emphasize delivering quality';
                $data['phrase_color'] = '#ffffff';
                break;
            case 4:
                $data['tmp'] = 'Login';
                $data['keys_'] = 'Login, Authentication, Address, Email, Little, India, Academy, School, Sparkle, Little Sparkel Academy, Motahaldu, Haldwani';
                $data['desc_'] = 'Motive is to improve and maintain core academics in order to facilitate development of concepts and ideas within the young creative minds.';
                $data['pagename'] = 'Login';
                $data['page_phrase'] = 'Admisintrative Corner';
                $data['phrase_color'] = '#ffffff';
                break;
            case 5:
                $data['tmp'] = 'Contact us';
                $data['keys_'] = 'Contact, Address, Email, Little, India, Academy, School, Sparkle, Little Sparkel Academy, Motahaldu, Haldwani';
                $data['desc_'] = 'Motive is to improve and maintain core academics in order to facilitate development of concepts and ideas within the young creative minds.';
                $data['pagename'] = 'Contact Us';
                $data['page_phrase'] = 'We are here to assist you.';
                $data['phrase_color'] = '#ffffff';
                break;
            case 6:
                $data['tmp'] = 'Gallery';
                $data['keys_'] = 'Gallery, Contact, Address, Email, Little, India, Academy, School, Sparkle, Little Sparkel Academy, Motahaldu, Haldwani';
                $data['desc_'] = 'Motive is to improve and maintain core academics in order to facilitate development of concepts and ideas within the young creative minds.';
                $data['pagename'] = 'Gallery';
                $data['page_phrase'] = 'Get the feel of Sparkle in Picutres';
                $data['phrase_color'] = '#ffffff';
                break;
            case 7:
                $data['tmp'] = 'Kids Corner';
                $data['keys_'] = 'Kids Corner, Gallery, Contact, Address, Email, Little, India, Academy, School, Sparkle, Little Sparkel Academy, Motahaldu, Haldwani';
                $data['desc_'] = 'Motive is to improve and maintain core academics in order to facilitate development of concepts and ideas within the young creative minds.';
                $data['pagename'] = 'Kids Corner';
                $data['page_phrase'] = 'Sparkle kids';
                $data['phrase_color'] = '#ffffff';
                break;
            case 8:
                $data['tmp'] = 'Message';
                $data['keys_'] = 'Kids Corner, Gallery, Contact, Address, Email, Little, India, Academy, School, Sparkle, Little Sparkel Academy, Motahaldu, Haldwani';
                $data['desc_'] = 'Motive is to improve and maintain core academics in order to facilitate development of concepts and ideas within the young creative minds.';
                $data['pagename'] = 'Message';
                $data['page_phrase'] = 'Direcotr/Principal Message';
                $data['phrase_color'] = '#ffffff';
                break;
            default:
                $data['tmp'] = 'Heading Error';
                $data['keys_'] = _SCHOOL_;
                $data['desc_'] = _SCHOOL_;
                $data['pagename'] = _SCHOOL_;
                $data['page_phrase'] = 'x';
                $data['phrase_color'] = '#ffffff';
        }
        return $data;
    }

    function image_for_page($value_) {
        switch ($value_) {
            case 1:
                $tmp = "about";
                break;
            case 2:
                $tmp = "about";
                break;
            case 3:
                $tmp = "gallery";
                break;
            case 4:
                $tmp = "login";
                break;
            case 5:
                $tmp = "contact";
                break;
            case 6:
                $tmp = "gallery";
                break;
            case 7:
                $tmp = "gallery";
                break;
            case 8:
                $tmp = "message";
                break;
            default:
                $tmp = "about";
        }
        return $tmp;
    }

    function get_days_($value_) {
        switch ($value_) {
            case 'Mon':
                $tmp = 'MONDAY';
                break;
            case 'Tue':
                $tmp = 'TUESDAY';
                break;
            case 'Wed':
                $tmp = 'WEDNESSDAY';
                break;
            case 'Thu':
                $tmp = 'THURSDAY';
                break;
            case 'Fri':
                $tmp = 'FRIDAY';
                break;
            case 'Sat':
                $tmp = 'SATURDAY';
                break;
            case 'Sun':
                $tmp = 'SUNDAY';
                break;
            default:
                $tmp = "No Day";
        }
        return $tmp;
    }

}
