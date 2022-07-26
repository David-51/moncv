export function CheckName(id){     
    const firstname = document.getElementById(id);
        const regex = new RegExp(/[A-z0-9éâêèàù'\s]+/);        
        return regex.test(firstname.value);
}

export function CheckMail(id){ 
    const mail = document.getElementById(id);
    const regex = new RegExp(/[\w+-?]+@[a-zA-Z_]{2,}?\.[a-zA-Z]{2,6}/);
    return regex.test(mail.value);           
    
}

export function CheckSelect(id){
    const select = document.getElementById(id);
    return select.selectedIndex !== 0 ? true : false;
}

export function CheckTextarea(id){
    return (document.getElementById(id).value !== (null || '') ? true : false);
}