node {
 	// Clean workspace before doing anything
    sh "sudo chmod 777 -R /var/lib/jenkins/workspace/SA-Proyecto"
    deleteDir()

    try {
        stage ('Clone') {
        	checkout scm
        }
        stage ('Build') {
		sh "echo 'shell scripts to deploy to server....'"
            sh "sudo composer install -d /var/lib/jenkins/workspace/SA-Proyecto/"
        }
	stage ('Push') {
		sh "echo 'shell scripts to deploy to server...'"
      	}
        stage ('Tests') {
	    /*    sh "echo 'shell scripts to deploy to server....'"
	        sh "echo 'shell scripts to deploy to server....'"
            sh 'sudo /var/lib/jenkins/workspace/SA-Proyecto/vendor/bin/phpunit'
            sh 'sudo ab -k -n800 -c100 -H "Accept-Encoding: gzip,deflate" http://104.196.194.35/api/v1/dptos'
            sh 'sudo ab -k -n800 -c100 -H "Accept-Encoding: gzip,deflate" http://104.196.194.35/api/v1/dpi_consulta/%7B%22cui%22:%222942637562001%22%7D'
            sh 'sudo ab -k -n800 -c100 -H "Accept-Encoding: gzip,deflate" http://104.196.194.35/api/v1/reg_matri/{"cuiHombre":"2120000470507","cuiMujer":"2120010811308","municipio":"1","lugarMatrimonio":"Ciudad","fechaMatrimonio":"1999-01-01","regimenMatrimonial":"bienes mancomunados"}'
            sh 'sudo ab -k -n800 -c100 -H "Accept-Encoding: gzip,deflate" http://104.196.194.35/api/v1/consul_matri/%7B"cuiHombre":"2120000470507","cuiMujer":"2120010811308"%7D'
            sh 'sudo ab -k -n800 -c100 -H "Accept-Encoding: gzip,deflate" http://104.196.194.35/api/v1/registrarNacimiento/%7B"nombre":"xxxxxx","apellido":"xxxxxx","genero":"xxxxxx","fechaNacimiento":"xxxxxx","municipio":"xxxxxx","lugarNacimiento":"xxxxxx","cuiPadre":"xxxxxx","cuiMadre":"xxxxxx"%7D'
            sh 'sudo ab -k -n800 -c100 -H "Accept-Encoding: gzip,deflate" http://104.196.194.35/api/divorcio/registro_divorcio/%7B%22cuiHombre%22:%222942637562001%22,%22cuiMujer%22:%222942637562002%22,%22municipio%22:%221%22,%22lugarDivorcio%22:%22sssss%22,%22fechaDivorcio%22:%222000-02-02%22%7D'
            sh 'sudo ab -k -n800 -c100 -H "Accept-Encoding: gzip,deflate" http://104.196.194.35/api/divorcio/consultar_divorcio/%7B"cuiHombre":"2942637562001","cuiMujer":"2942637562002"%7D'
            */
        }   
      	stage ('Deploy') {
            sh "sudo rm -rf /var/www/html/SA-Proyecto"
            sh "sudo cp -R /var/lib/jenkins/workspace/SA-Proyecto/ /var/www/html/"
            sh "sudo chgrp -R www-data /var/www/html/SA-Proyecto"
            sh "sudo chmod -R 775 /var/www/html/SA-Proyecto/storage"
            //sh "sudo composer install -d /var/www/html/SA-Proyecto"
            //sh "sudo mkdir /var/lib/jenkins/workspace/SA-Proyecto"
      	}
    } catch (err) {
        currentBuild.result = 'FAILED'
        throw err
    }
}
