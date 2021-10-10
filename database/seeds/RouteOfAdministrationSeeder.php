<?php

use Illuminate\Database\Seeder;
use App\Model\ProductSetup\RouteOfAdministration;

class RouteOfAdministrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RouteOfAdministration::truncate();

        $route_of_administrations = array(
            array('ctg_via_id' => 'NA','ctg_via_desc' => 'Data not available','ctg_via_obs' => '','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => '803223','ctg_via_dt' => '2017-10-27 23:26:06'),
            array('ctg_via_id' => '9999','ctg_via_desc' => 'UNASSIGNED','ctg_via_obs' => '','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => '803223','ctg_via_dt' => '2017-12-13 03:19:05'),
            array('ctg_via_id' => '2','ctg_via_desc' => 'BUCCAL','ctg_via_obs' => 'Administration directed toward the cheek, generally from within the mouth.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '3','ctg_via_desc' => 'CONJUNCTIVAL','ctg_via_obs' => 'Administration to the conjunctiva, the delicate membrane that lines the eyelids and covers the exposed surface of the eyeball.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '4','ctg_via_desc' => 'CUTANEOUS','ctg_via_obs' => 'Administration to the skin.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '5','ctg_via_desc' => 'DENTAL','ctg_via_obs' => 'Administration to a tooth or teeth.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '6','ctg_via_desc' => 'ELECTRO-OSMOSIS','ctg_via_obs' => 'Administration of through the diffusion of substance through a membrane in an electric field.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '7','ctg_via_desc' => 'ENDOCERVICAL','ctg_via_obs' => 'Administration within the canal of the cervix uteri.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '8','ctg_via_desc' => 'ENDOSINUSIAL','ctg_via_obs' => 'Administration within the nasal sinuses of the head.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '9','ctg_via_desc' => 'ENDOTRACHEAL','ctg_via_obs' => 'Administration directly into the trachea.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '10','ctg_via_desc' => 'ENTERAL','ctg_via_obs' => 'Administration directly into the intestines.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '11','ctg_via_desc' => 'EPIDURAL','ctg_via_obs' => 'Administration upon or over the dura mater.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '12','ctg_via_desc' => 'EXTRA?AMNIOTIC','ctg_via_obs' => 'Administration to the outside of the membrane enveloping the fetus','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '13','ctg_via_desc' => 'EXTRACORPOREAL','ctg_via_obs' => 'Administration outside of the body.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '14','ctg_via_desc' => 'HEMODIALYSIS','ctg_via_obs' => 'Administration through hemodialysate fluid.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '15','ctg_via_desc' => 'INFILTRATION','ctg_via_obs' => 'Administration that results in substances passing into tissue spaces or into cells.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '16','ctg_via_desc' => 'INTERSTITIAL','ctg_via_obs' => 'Administration to or in the interstices of a tissue.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '17','ctg_via_desc' => 'INTRA-ABDOMINAL','ctg_via_obs' => 'Administration within the abdomen.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '18','ctg_via_desc' => 'INTRA-AMNIOTIC','ctg_via_obs' => 'Administration within the amnion.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '19','ctg_via_desc' => 'INTRA-ARTERIAL','ctg_via_obs' => 'Administration within an artery or arteries.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '20','ctg_via_desc' => 'INTRA-ARTICULAR','ctg_via_obs' => 'Administration within a joint.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '21','ctg_via_desc' => 'INTRABILIARY','ctg_via_obs' => 'Administration within the bile, bile ducts or gallbladder.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '22','ctg_via_desc' => 'INTRABRONCHIAL','ctg_via_obs' => 'Administration within a bronchus.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '23','ctg_via_desc' => 'INTRABURSAL','ctg_via_obs' => 'Administration within a bursa.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '24','ctg_via_desc' => 'INTRACARDIAC','ctg_via_obs' => 'Administration with the heart.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '25','ctg_via_desc' => 'INTRACARTILAGINOUS','ctg_via_obs' => 'Administration within a cartilage; endochondral.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '26','ctg_via_desc' => 'INTRACAUDAL','ctg_via_obs' => 'Administration within the cauda equina.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '27','ctg_via_desc' => 'INTRACAVERNOUS','ctg_via_obs' => 'Administration within a pathologic cavity, such as occurs in the lung in tuberculosis.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '28','ctg_via_desc' => 'INTRACAVITARY','ctg_via_obs' => 'Administration within a non-pathologic cavity, such as that of the cervix, uterus, or penis, or such as that which is formed as the result of a wound.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '29','ctg_via_desc' => 'INTRACEREBRAL','ctg_via_obs' => 'Administration within the cerebrum.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '30','ctg_via_desc' => 'INTRACISTERNAL','ctg_via_obs' => 'Administration within the cisterna magna cerebellomedularis.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '31','ctg_via_desc' => 'INTRACORNEAL','ctg_via_obs' => 'Administration within the cornea (the transparent structure forming the anterior part of the fibrous tunic of the eye).','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '32','ctg_via_desc' => 'INTRACORONAL, DENTAL','ctg_via_obs' => 'Administration of a drug within a portion of a tooth which is covered by enamel and which is separated from the roots by a slightly constricted region known as the neck.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '33','ctg_via_desc' => 'INTRACORONARY','ctg_via_obs' => 'Administration within the coronary','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '34','ctg_via_desc' => 'INTRACORPORUS CAVERNOSUM','ctg_via_obs' => 'Administration within the dilatable spaces of the corporus cavernosa of the penis.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '35','ctg_via_desc' => 'INTRADERMAL','ctg_via_obs' => 'Administration within the dermis.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '36','ctg_via_desc' => 'INTRADISCAL','ctg_via_obs' => 'Administration within a disc.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '37','ctg_via_desc' => 'INTRADUCTAL','ctg_via_obs' => 'Administration within the duct of a gland.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '38','ctg_via_desc' => 'INTRADUODENAL','ctg_via_obs' => 'Administration within the duodenum.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '39','ctg_via_desc' => 'INTRADURAL','ctg_via_obs' => 'Administration within or beneath the dura.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '40','ctg_via_desc' => 'INTRAEPIDERMAL','ctg_via_obs' => 'Administration within the epidermis.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '41','ctg_via_desc' => 'INTRAESOPHAGEAL','ctg_via_obs' => 'Administration within the esophagus.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '42','ctg_via_desc' => 'INTRAGASTRIC','ctg_via_obs' => 'Administration within the stomach.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '43','ctg_via_desc' => 'INTRAGINGIVAL','ctg_via_obs' => 'Administration within the gingivae.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '44','ctg_via_desc' => 'INTRAILEAL','ctg_via_obs' => 'Administration within the distal portion of the small intestine, from the jejunum to the cecum.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '45','ctg_via_desc' => 'INTRALESIONAL','ctg_via_obs' => 'Administration within or introduced directly into a localized lesion.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '46','ctg_via_desc' => 'INTRALUMINAL','ctg_via_obs' => 'Administration within the lumen of a tube.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '47','ctg_via_desc' => 'INTRALYMPHATIC','ctg_via_obs' => 'Administration within the lymph.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '48','ctg_via_desc' => 'INTRAMEDULLARY','ctg_via_obs' => 'Administration within the marrow cavity of a bone.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '49','ctg_via_desc' => 'INTRAMENINGEAL','ctg_via_obs' => 'Administration within the meninges (the three membranes that envelope the brain and spinal cord).','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '50','ctg_via_desc' => 'INTRAMUSCULAR','ctg_via_obs' => 'Administration within a muscle.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '51','ctg_via_desc' => 'INTRAOCULAR','ctg_via_obs' => 'Administration within the eye.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '52','ctg_via_desc' => 'INTRAOVARIAN','ctg_via_obs' => 'Administration within the ovary.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '53','ctg_via_desc' => 'INTRAPERICARDIAL','ctg_via_obs' => 'Administration within the pericardium.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '54','ctg_via_desc' => 'INTRAPERITONEAL','ctg_via_obs' => 'Administration within the peritoneal cavity.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '55','ctg_via_desc' => 'INTRAPLEURAL','ctg_via_obs' => 'Administration within the pleura.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '56','ctg_via_desc' => 'INTRAPROSTATIC','ctg_via_obs' => 'Administration within the prostate gland.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '57','ctg_via_desc' => 'INTRAPULMONARY','ctg_via_obs' => 'Administration within the lungs or its bronchi.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '58','ctg_via_desc' => 'INTRASINAL','ctg_via_obs' => 'Administration within the nasal or periorbital sinuses.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '59','ctg_via_desc' => 'INTRASPINAL','ctg_via_obs' => 'Administration within the vertebral column.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '60','ctg_via_desc' => 'INTRASYNOVIAL','ctg_via_obs' => 'Administration within the synovial cavity of a joint.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '61','ctg_via_desc' => 'INTRATENDINOUS','ctg_via_obs' => 'Administration within a tendon.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '62','ctg_via_desc' => 'INTRATESTICULAR','ctg_via_obs' => 'Administration within the testicle.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '63','ctg_via_desc' => 'INTRATHECAL','ctg_via_obs' => 'Administration within the cerebrospinal fluid at any level of the cerebrospinal axis, including injection into the cerebral ventricles.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '64','ctg_via_desc' => 'INTRATHORACIC','ctg_via_obs' => 'Administration within the thorax (internal','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '65','ctg_via_desc' => 'INTRATUBULAR','ctg_via_obs' => 'Administration within the tubules of an organ.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '66','ctg_via_desc' => 'INTRATUMOR','ctg_via_obs' => 'Administration within a tumor.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '67','ctg_via_desc' => 'INTRATYMPANIC','ctg_via_obs' => 'Administration within the aurus media.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '68','ctg_via_desc' => 'INTRAUTERINE','ctg_via_obs' => 'Administration within the uterus.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '69','ctg_via_desc' => 'INTRAVASCULAR','ctg_via_obs' => 'Administration within a vessel or vessels.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '70','ctg_via_desc' => 'INTRAVENOUS','ctg_via_obs' => 'Administration within or into a vein or veins.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '71','ctg_via_desc' => 'INTRAVENOUS BOLUS','ctg_via_obs' => 'Administration within or into a vein or veins all at once.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '72','ctg_via_desc' => 'INTRAVENOUS DRIP','ctg_via_obs' => 'Administration within or into a vein or veins over a sustained period of time.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '73','ctg_via_desc' => 'INTRAVENTRICULAR','ctg_via_obs' => 'Administration within a ventricle.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '74','ctg_via_desc' => 'INTRAVESICAL','ctg_via_obs' => 'Administration within the bladder.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '75','ctg_via_desc' => 'INTRAVITREAL','ctg_via_obs' => 'Administration within the vitreous body of the eye.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '76','ctg_via_desc' => 'IONTOPHORESIS','ctg_via_obs' => 'Administration by means of an electric current where ions of soluble salts migrate into the tissues of','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '77','ctg_via_desc' => 'IRRIGATION','ctg_via_obs' => 'Administration to bathe or flush open wounds or body cavities.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '78','ctg_via_desc' => 'LARYNGEAL','ctg_via_obs' => 'Administration directly upon the larynx.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '79','ctg_via_desc' => 'NASAL','ctg_via_obs' => 'Administration to the nose; administered by way of the nose.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '80','ctg_via_desc' => 'NASOGASTRIC','ctg_via_obs' => 'Administration through the nose and into the stomach, usually by means of a tube.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '81','ctg_via_desc' => 'NOT APPLICABLE','ctg_via_obs' => 'Routes of administration are not applicable.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '82','ctg_via_desc' => 'OCCLUSIVE DRESSING TECHNIQUE','ctg_via_obs' => 'Administration by the topical route which is then covered by a dressing which occludes the area.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '83','ctg_via_desc' => 'OPHTHALMIC','ctg_via_obs' => 'Administration to the external eye.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '84','ctg_via_desc' => 'ORAL','ctg_via_obs' => 'Administration to or by way of the mouth.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '85','ctg_via_desc' => 'OROPHARYNGEAL','ctg_via_obs' => 'Administration directly to the mouth and pharynx.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '86','ctg_via_desc' => 'OTHER','ctg_via_obs' => 'Administration is different from others on this list.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '87','ctg_via_desc' => 'PARENTERAL','ctg_via_obs' => 'Administration by injection, infusion, or implantation.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '88','ctg_via_desc' => 'PERCUTANEOUS','ctg_via_obs' => 'Administration through the skin.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '89','ctg_via_desc' => 'PERIARTICULAR','ctg_via_obs' => 'Administration around a joint.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '90','ctg_via_desc' => 'PERIDURAL','ctg_via_obs' => 'Administration to the outside of the dura mater of the spinal cord..','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '91','ctg_via_desc' => 'PERINEURAL','ctg_via_obs' => 'Administration surrounding a nerve or nerves.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '92','ctg_via_desc' => 'PERIODONTAL','ctg_via_obs' => 'Administration around a tooth.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '93','ctg_via_desc' => 'RECTAL','ctg_via_obs' => 'Administration to the rectum.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '94','ctg_via_desc' => 'RESPIRATORY (INHALATION)','ctg_via_obs' => 'Administration within the respiratory tract by inhaling orally or nasally for local or systemic effect.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '95','ctg_via_desc' => 'RETROBULBAR','ctg_via_obs' => 'Administration behind the pons or behind the eyeball.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '96','ctg_via_desc' => 'SOFT TISSUE','ctg_via_obs' => 'Administration into any soft tissue.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '97','ctg_via_desc' => 'SUBARACHNOID','ctg_via_obs' => 'Administration beneath the arachnoid.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '98','ctg_via_desc' => 'SUBCONJUNCTIVAL','ctg_via_obs' => 'Administration beneath the conjunctiva.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '99','ctg_via_desc' => 'SUBCUTANEOUS','ctg_via_obs' => 'Administration beneath the skin; hypodermic.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '100','ctg_via_desc' => 'SUBLINGUAL','ctg_via_obs' => 'Administration beneath the tongue.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '101','ctg_via_desc' => 'SUBMUCOSAL','ctg_via_obs' => 'Administration beneath the mucous membrane.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '102','ctg_via_desc' => 'TOPICAL','ctg_via_obs' => 'Administration to a particular spot on the outer surface of the body. The E2B term TRANSMAMMARY','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '103','ctg_via_desc' => 'TRANSDERMAL','ctg_via_obs' => 'Administration through the dermal layer of the skin to the systemic circulation by diffusion.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '104','ctg_via_desc' => 'TRANSMUCOSAL','ctg_via_obs' => 'Administration across the mucosa.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '105','ctg_via_desc' => 'TRANSPLACENTAL','ctg_via_obs' => 'Administration through or across the placenta.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '106','ctg_via_desc' => 'TRANSTRACHEAL','ctg_via_obs' => 'Administration through the wall of the trachea.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '107','ctg_via_desc' => 'TRANSTYMPANIC','ctg_via_obs' => 'Administration across or through the tympanic cavity.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '108','ctg_via_desc' => 'UNASSIGNED','ctg_via_obs' => 'Route of administration has not yet been assigned.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '109','ctg_via_desc' => 'UNKNOWN','ctg_via_obs' => 'Route of administration is unknown.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '110','ctg_via_desc' => 'URETERAL','ctg_via_obs' => 'Administration into the ureter.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '111','ctg_via_desc' => 'URETHRAL','ctg_via_obs' => 'Administration into the urethra.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00'),
            array('ctg_via_id' => '112','ctg_via_desc' => 'VAGINAL','ctg_via_obs' => 'Administration into the vagina.','ctg_tpr_id' => '02','ctg_via_sta' => '1','ctg_via_usr' => 'MASTER','ctg_via_dt' => '2017-09-10 20:00:00')
          );
        $route_of_administrations = array(
            ['name' => 'Antibiotics', 'description' => ''],
            ['name' => 'Injections/ Infusions/ Eye Drops', 'description' => ''],
            ['name' => 'Oral', 'description' => ''],
            ['name' => 'Disinfectants', 'description' => ''],
            ['name' => 'Cosmetics', 'description' => ''],
            ['name' => 'Other', 'description' => ''],
        );

        foreach($route_of_administrations as $route_of_administration) {
            RouteOfAdministration::create([
                'name' => $route_of_administration['name'],
                'description' => $route_of_administration['description']
            ]);
        }

    }
}