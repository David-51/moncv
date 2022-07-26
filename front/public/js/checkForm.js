import { CheckMail, CheckName, CheckSelect, CheckTextarea } from "./checkFields.js";
import helper from "./helper.js";

export default function CheckForm(id){
    
    const firstnameMessage = "Vous devez entrer un prénom valide";
    const lastnameMessage = "Vous devez entrer un nom valide";
    const emailMessage = "Vous devez entrer une adresse mail valide";
    const subjectMessage = "Veuillez choisir un sujet";
    const projectMessage = "Veuillez remplir le champs de description";

    const form = document.getElementById(id);
    const submitbutton = document.getElementById('formsubmit');    

    form.addEventListener('input', (event) => {
        event.preventDefault();        
        if(CheckName('firstname') && CheckName('lastname') && CheckSelect('subject') && CheckMail('email') && CheckTextarea('project')){
            submitbutton.classList.remove('disabled');
            helper('')
        }else{
            if(!CheckName('lastname')){
                helper(lastnameMessage);
            }else{
                if(!CheckName('firstname')){
                    helper(firstnameMessage);
                }else{
                    if(!CheckMail('email')){
                        helper(emailMessage);
                    }else{
                        if(!CheckSelect('subject')){
                            helper(subjectMessage);
                        }else{
                            if(!CheckTextarea('project')){
                                helper(projectMessage);
                            }else{
                                helper('');
                            }
                        }
                    }
                }
            }
        }
    })
}
