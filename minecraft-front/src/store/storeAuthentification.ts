import { reactive } from 'vue'

export const storeAuthentification = reactive({
    JWT: "",
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
    }
});
