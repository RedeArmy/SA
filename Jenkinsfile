node {
 	// Clean workspace before doing anything
    deleteDir()

    try {
        stage ('Clone') {
        	checkout scm
        }
        stage ('Build') {
		sh "echo 'shell scripts to deploy to server....'"
        }
        stage ('Tests') {
	        sh "echo 'shell scripts to deploy to server....'"
	        sh "echo 'shell scripts to deploy to server....'"
        }
	stage ('Push') {
		sh "echo 'shell scripts to deploy to server...'"
      	}   
      	stage ('Deploy') {
            sh "sudo rm -rf /var/www/html/SA-Proyecto"
            sh "sudo mv /var/lib/jenkins/workspace/SA-Proyecto/ /var/www/html/SA-Proyecto/"
            sh "sudo chgrp -R www-data /var/www/html/SA-Proyecto"
            sh "sudo chmod -R 775 /var/www/html/SA-Proyecto/storage"
            sh "sudo mkdir /var/lib/jenkins/workspace/SA-Proyecto"
      	}
    } catch (err) {
        currentBuild.result = 'FAILED'
        throw err
    }
}
