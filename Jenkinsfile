node {
 	// Clean workspace before doing anything

    try {
        stage ('Clone') {
            sh "sudo rm -rf /var/lib/jenkins/workspace/SA-Proyecto"
            sh "sudo mkdir /var/lib/jenkins/workspace/SA-Proyecto/"
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
	        sh "echo 'shell scripts to deploy to server....'"
	        sh "echo 'shell scripts to deploy to server....'"
            sh 'sudo /var/lib/jenkins/workspace/SA-Proyecto/vendor/bin/phpunit'
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
