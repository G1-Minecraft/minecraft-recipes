import { reactive } from 'vue'

interface Data{
    mail : string
}

interface Authentification {
    JWT: string,
    data: Data,
    estConnecte: boolean,
    connexion(login: string, motDePasse: string, succes:()=>void, echec:()=>void): void,
    inscription(login: string, motDePasse: string, email:string, succes:()=>void, echec:()=>void): void,
    deconnexion(): void
}

function decodeToken(token: string) {
    const base64Url = token.split('.')[1];
    const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
    const jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
    }).join(''));
    return JSON.parse(jsonPayload);
}

export const storeAuthentification = reactive<Authentification>({
    JWT: "",
    data: {
        mail: ''
    },
    estConnecte: false,
    connexion(login: string, motDePasse: string, succes:()=>void, echec:()=>void): void{
        fetch( "http://localhost:8210/api/auth", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                login: login,
                password: motDePasse
            })
        })
            .then (reponse => reponse.json())
            .then(values => {
                    this.JWT = values.token
                    this.data = decodeToken(this.JWT)
                    this.estConnecte = true
                    succes();
                }
            )
            .catch(() => echec());
    },
    inscription(login: string, motDePasse: string, email:string, succes:()=>void, echec:()=>void){
        fetch("http://localhost:8210/api/users", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                login: login,
                plainPassword: motDePasse,
                email: email
            })
        })
            .then (reponse => reponse.json())
            .then(() => {
                    succes();
                }
            )
            .catch(() => echec());
    },
    deconnexion(){
        this.JWT = ""
        localStorage.removeItem('JWT');
        this.estConnecte = false
    },

});
