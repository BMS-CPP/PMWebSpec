<?php
$user_id_session =& get_instance();
$user_id_session->load->model('CIModSession');
$users_id = $user_id_session->CIModSession->checkIsSessionExist();

if ($users_id == 0) {
	echo "Please Login";
	die();
}
$user_name = $this->session->user_details;
$url = base_url();
if ($user_name[0]['user_id'] == NULL) {
	if (!(strpos($url, 'localhost') != 0)) {
		redirect(base_url('error/unauthorized'));
	}
}
//print_r($dataset_structure);exit;
//dataset information
     // if($dataset_general !== FALSE) {
  if($dataset_structure !== FALSE) {
           foreach ($dataset_structure as  $sts) {

                  $varnames[] = $sts['var_name'];
                  if ($sts['var_units']=="NA") {
                        $varlabels[] = $sts['var_name'] . ' = "' . $sts['var_label'] . '"';
                  } else {
                        $varlabels[] = $sts['var_name'] . ' = "' . $sts['var_label'] . '[' . $sts['var_units'] . ']"';
                  }

                  if ($sts['var_missing_value']=='-99') {
                        $miss99[] = $sts['var_name'];
                  }

                  if ($sts['var_rounding']=='0.1') {
                        $round1[] = $sts['var_name'];
                  } elseif ($sts['var_rounding']=='0.01') {
                        $round2[] = $sts['var_name'];
                  } elseif ($sts['var_rounding']=='0.001') {
                        $round3[] = $sts['var_name'];
                  } elseif ($sts['var_rounding']=='4 significant digits') {
                        $round4[] = $sts['var_name'];
                  } elseif ($sts['var_rounding']=='3 significant digits') {
                        $round5[] = $sts['var_name'];
                  } elseif ($sts['var_rounding']=='1') {
                        $round6[] = $sts['var_name'];
                  }                    
            }

            $vars = implode(' ', $varnames);
            $dataset_sort = str_replace(",", " ", $dataset_sort);
      }      
?>

	<body>
		<div class="small">
		<?php 
            $dataset_type = $user_spec[0]['type'];
            $parts = explode('-', $dataset_type);

            if (in_array('ISOP', $parts)) 
            {
                  echo "
                              <pre><font size='4' color='red'>* --------------------- hepatic function ------------------ *; </font></pre>

                              <pre>length hepa $ 20; </pre>
                              <pre>if n(ulntbili, tbilb)=2 then do;</pre>
                              <pre>   ulntbili15=1.5*ulntbili;</pre>
                              <pre>   ulntbili3=3*ulntbili;</pre>
                              <pre>   select;</pre>
                              <pre>      when (tbilb > ulntbili3) do;</pre>
                              <pre>           hepa='GROUP D: Severe';</pre>
                              <pre>           hepan=4;</pre>
                              <pre>      end;</pre>
                              <pre>      when (ulntbili15 < tbilb <= ulntbili3) do;</pre>
                              <pre>         hepa='GROUP C: Moderate';</pre>
                              <pre>         hepan=3;</pre>
                              <pre>      end;</pre>
                              <pre>      when ((ulntbili < tbilb <= ulntbili15) or (n(ulnast, astb)=2 and astb > ulnast)) do; *hepan=2 for tbilb OR astb;</pre>
                              <pre>         hepa='GROUP B: Mild';</pre>
                              <pre>         hepan=2;</pre>
                              <pre>      end;</pre>
                              <pre>      when ((tbilb <= ulntbili) and (n(ulnast, astb)=2 and astb <= ulnast)) do; *hepan=1 if <=ULN for tbilb AND astb;</pre>
                              <pre>         hepa='GROUP A: Normal';</pre>
                              <pre>         hepan=1;</pre>
                              <pre>      end;</pre>
                              <pre>       when ((tbilb <= ulntbili) and n(ulnast, astb) < 2) do; *unable to assign hepa/hepan if tbilb<=ULN, but astb or ulnast is missing;</pre>
                              <pre>         hepa='';</pre>
                              <pre>         hepan=.;</pre>
                              <pre>      end;</pre>
                              <pre>      otherwise;</pre>
                              <pre>   end;</pre>
                              <pre>end;</pre>
                              <pre>else do; *hepa value missing if tbilb or ulntbili value missing;</pre>
                              <pre>   hepa='';</pre>
                              <pre>   hepan=.;</pre>
                              <pre>end;</pre>
                              <br />";
                              echo '<br />
                              <pre><font size="4" color="red">* ---------------- EGFRB, CRCLB and IBWB -------------- *; </font></pre>

                              <pre>****** EGFRB ******;</pre>
                              <pre>if age > 18 then do;</pre>
                              <pre>    if sexn=1 then do; * male;</pre>
                              <pre>        k=.9;</pre> 
                              <pre>        a=-.411; </pre>
                              <pre>    end; </pre>
                              <pre>    else if sexn=2 then do; * female;</pre>
                              <pre>        k=.7; </pre>
                              <pre>        a=-.329; </pre>
                              <pre>    end;      </pre>    
                              <pre>    if n(creatb, sexn, racen)=3 then do; </pre>
                              <pre>        egfrb=141*(min((creatb/k),1)**a)*(max(creatb/k,1)**-1.209)*(0.993**age); </pre>
                              <pre>        if sexn=2 then egfrb=egfrb*1.018;</pre> 
                              <pre>        if racen=2 then egfrb=egfrb*1.159; </pre>
                              <pre>    end; </pre>
                              <pre>end;</pre>
                              <pre>else if 0 < age <= 18 then do;   </pre>    
                              <pre>    if n(creatb, htb)=2 then egfrb=0.413*(htb/creatb);</pre>
                              <pre>end;</pre>
                              <pre>drop k a; </pre>
                              <pre>****** CRCLB  ******; </pre>
                              <pre>    if n(wtb, creatb, sexn, age)=4 then crclb=(((140-age)*wtb)/(72*creatb)); </pre>
                              <pre>    if sexn=2 and crclb>. then crclb=crclb * 0.85; </pre>
                              
                              <pre>****** IBWB ******;</pre>
                              <pre>if n(htb, sexn)=2 then do; </pre>
                              <pre>    ht_in = htb*0.3937; * 1 cm = 0.3937 in; </pre>
                              <pre>    if sexn=1 then do; </pre>
                              <pre>        if ht_in > 60 then ibwb=50+2.3*(ht_in-60);</pre> 
                              <pre>        else ibwb=50; </pre>
                              <pre>    end; </pre>
                              <pre>    else if sexn =2 then do; </pre>
                              <pre>        if ht_in > 60 then ibwb=45.5+2.3*(ht_in-60); </pre>
                              <pre>        else ibwb=45.5; </pre>
                              <pre>    end; </pre>
                              <pre>end; </pre>
                              <br />';
            }
            else
            {
                  if (strpos($dataset_type, 'PPK') !== false) {
                        echo "
                              <pre><font size='4' color='red'>* --------------------- hepatic function ------------------ *; </font></pre>

                              <pre>length hepa $ 20; </pre>
                              <pre>if n(ulntbili, tbilb)=2 then do;</pre>

                              <pre>   ulntbili15=1.5*ulntbili;</pre>
                              <pre>   ulntbili3=3*ulntbili;</pre>

                              <pre>   select;</pre>
                              <pre>      when (tbilb > ulntbili3) do;</pre>
                              <pre>           hepa='GROUP D: Severe';</pre>
                              <pre>           hepan=4;</pre>
                              <pre>      end;</pre>
                              <pre>      when (ulntbili15 < tbilb <= ulntbili3) do;</pre>
                              <pre>         hepa='GROUP C: Moderate';</pre>
                              <pre>         hepan=3;</pre>
                              <pre>      end;</pre>
                              <pre>      when ((ulntbili < tbilb <= ulntbili15) or (n(ulnast, astb)=2 and astb > ulnast)) do; *hepan=2 for tbilb OR astb;</pre>
                              <pre>         hepa='GROUP B: Mild';</pre>
                              <pre>         hepan=2;</pre>
                              <pre>      end;</pre>
                              <pre>      when ((tbilb <= ulntbili) and (n(ulnast, astb)=2 and astb <= ulnast)) do; *hepan=1 if <=ULN for tbilb AND astb;</pre>
                              <pre>         hepa='GROUP A: Normal';</pre>
                              <pre>         hepan=1;</pre>
                              <pre>      end;</pre>
                              <pre>       when ((tbilb <= ulntbili) and n(ulnast, astb) < 2) do; *unable to assign hepa/hepan if tbilb<=ULN, but astb or ulnast is missing;</pre>
                              <pre>         hepa='';</pre>
                              <pre>         hepan=.;</pre>
                              <pre>      end;</pre>
                              <pre>      otherwise;</pre>
                              <pre>   end;</pre>
                              <pre>end;</pre>
                              <pre>else do; *hepa value missing if tbilb or ulntbili value missing;</pre>
                              <pre>   hepa='';</pre>
                              <pre>   hepan=.;</pre>
                              <pre>end;</pre>
                              <br />";

                              echo '<pre><font size="4" color="red">* ---------------- BGFR, BCRCL and BIBW -------------- *; </font></pre>
                                
                                    <pre>****** EGFRB ******;</pre>
                                    <pre>if age > 18 then do;</pre>
                                    <pre>    if sexn=1 then do; * male ;</pre>
                                    <pre>        k=.9;</pre> 
                                    <pre>        a=-.411; </pre>
                                    <pre>    end; </pre>
                                    <pre>    else if sexn=2 then do; * female ;</pre>
                                    <pre>        k=.7; </pre>
                                    <pre>        a=-.329; </pre>
                                    <pre>    end;      </pre>    
                                    <pre>    if n(creatb, sexn, racen)=3 then do; </pre>
                                    <pre>        egfrb=141*(min((creatb/k),1)**a)*(max(creatb/k,1)**-1.209)*(0.993**age); </pre>
                                    <pre>        if sexn=2 then egfrb=egfrb*1.018;</pre> 
                                    <pre>        if racen=2 then egfrb=egfrb*1.159; </pre>
                                    <pre>    end; </pre>
                                    <pre>end;</pre>
                                    <pre>else if 0 < age <= 18 then do;   </pre>    
                                    <pre>    if n(creatb, htb)=2 then egfrb=0.413*(htb/creatb);</pre>
                                    <pre>end;</pre>
                                    <pre>drop k a ; </pre>
                                    <pre>****** CRCLB  ******; </pre>
                                    <pre>    if n(wtb, creatb, sexn, age)=4 then crclb=(((140-age)*wtb)/(72*creatb)); </pre>
                                    <pre>    if sexn=2 and crclb>. then crclb=crclb * 0.85; </pre>
                                    <pre>****** IBWB ******; </pre>
                                    <pre>if n(htb, sexn)=2 then do; </pre>
                                    <pre>    ht_in = htb*0.3937; * 1 cm = 0.3937 in ; </pre>
                                    <pre>    if sexn=1 then do; </pre>
                                    <pre>        if ht_in > 60 then ibwb=50+2.3*(ht_in-60);</pre> 
                                    <pre>        else ibwb=50; </pre>
                                    <pre>    end; </pre>
                                    <pre>    else if sexn =2 then do; </pre>
                                    <pre>        if ht_in > 60 then ibwb=45.5+2.3*(ht_in-60); </pre>
                                    <pre>        else ibwb=45.5; </pre>
                                    <pre>    end; </pre>
                                    <pre>end; </pre>

                                    <br />';
                     }
            }

            if($dataset_type == 'Blank Template')
            {
                 echo "<pre><font size='4' color='red'>* --------------------- hepatic function ------------------ *; </font></pre>

                              <pre>length hepa $ 20; </pre>
                              <pre>if n(ulntbili, tbilb)=2 then do;</pre>
                              <pre>   ulntbili15=1.5*ulntbili;</pre>
                              <pre>   ulntbili3=3*ulntbili;</pre>
                              <pre>   select;</pre>
                              <pre>      when (tbilb > ulntbili3) do;</pre>
                              <pre>           hepa='GROUP D: Severe';</pre>
                              <pre>           hepan=4;</pre>
                              <pre>      end;</pre>
                              <pre>      when (ulntbili15 < tbilb <= ulntbili3) do;</pre>
                              <pre>         hepa='GROUP C: Moderate';</pre>
                              <pre>         hepan=3;</pre>
                              <pre>      end;</pre>
                              <pre>      when ((ulntbili < tbilb <= ulntbili15) or (n(ulnast, astb)=2 and astb > ulnast)) do; *hepan=2 for tbilb OR astb;</pre>
                              <pre>         hepa='GROUP B: Mild';</pre>
                              <pre>         hepan=2;</pre>
                              <pre>      end;</pre>
                              <pre>      when ((tbilb <= ulntbili) and (n(ulnast, astb)=2 and astb <= ulnast)) do; *hepan=1 if <=ULN for tbilb AND astb;</pre>
                              <pre>         hepa='GROUP A: Normal';</pre>
                              <pre>         hepan=1;</pre>
                              <pre>      end;</pre>
                              <pre>       when ((tbilb <= ulntbili) and n(ulnast, astb) < 2) do; *unable to assign hepa/hepan if tbilb<=ULN, but astb or ulnast is missing;</pre>
                              <pre>         hepa='';</pre>
                              <pre>         hepan=.;</pre>
                              <pre>      end;</pre>
                              <pre>      otherwise;</pre>
                              <pre>   end;</pre>
                              <pre>end;</pre>
                              <pre>else do; *hepa value missing if tbilb or ulntbili value missing;</pre>
                              <pre>   hepa='';</pre>
                              <pre>   hepan=.;</pre>
                              <pre>end;</pre>
                              <br />";
                              echo '<br />
                              <pre><font size="4" color="red">* ---------------- EGFRB, CRCLB and IBWB -------------- *; </font></pre>

                              <pre>****** EGFRB ******;</pre>
                              <pre>if age > 18 then do;</pre>
                              <pre>    if sexn=1 then do; * male;</pre>
                              <pre>        k=.9;</pre> 
                              <pre>        a=-.411; </pre>
                              <pre>    end; </pre>
                              <pre>    else if sexn=2 then do; * female;</pre>
                              <pre>        k=.7; </pre>
                              <pre>        a=-.329; </pre>
                              <pre>    end;      </pre>    
                              <pre>    if n(creatb, sexn, racen)=3 then do; </pre>
                              <pre>        egfrb=141*(min((creatb/k),1)**a)*(max(creatb/k,1)**-1.209)*(0.993**age); </pre>
                              <pre>        if sexn=2 then egfrb=egfrb*1.018;</pre> 
                              <pre>        if racen=2 then egfrb=egfrb*1.159; </pre>
                              <pre>    end; </pre>
                              <pre>end;</pre>
                              <pre>else if 0 < age <= 18 then do;   </pre>    
                              <pre>    if n(creatb, htb)=2 then egfrb=0.413*(htb/creatb);</pre>
                              <pre>end;</pre>
                              <pre>drop k a; </pre>
                              <pre>****** CRCLB  ******; </pre>
                              <pre>    if n(wtb, creatb, sexn, age)=4 then crclb=(((140-age)*wtb)/(72*creatb)); </pre>
                              <pre>    if sexn=2 and crclb>. then crclb=crclb * 0.85; </pre>
                              
                              <pre>****** IBWB ******;</pre>
                              <pre>if n(htb, sexn)=2 then do; </pre>
                              <pre>    ht_in = htb*0.3937; * 1 cm = 0.3937 in; </pre>
                              <pre>    if sexn=1 then do; </pre>
                              <pre>        if ht_in > 60 then ibwb=50+2.3*(ht_in-60);</pre> 
                              <pre>        else ibwb=50; </pre>
                              <pre>    end; </pre>
                              <pre>    else if sexn =2 then do; </pre>
                              <pre>        if ht_in > 60 then ibwb=45.5+2.3*(ht_in-60); </pre>
                              <pre>        else ibwb=45.5; </pre>
                              <pre>    end; </pre>
                              <pre>end; </pre>
                              <br />'; 
            }
?>

		<pre><font size="4" color="red">* -------------- rounding and missing impute ----------- *; </font></pre>
		<pre>data your_dataset_name; </pre>
		<pre>    set your_dataset_name ; </pre>
		<?php 
 			if (isset($round1)) {
 				echo '<pre>    *** round to 0.1 ***; </pre>';
 				echo '<pre>    array rou01 [*] ' . implode(' ', $round1) . '; </pre>';
 				echo '<pre>    do i=1 to dim(rou01); </pre>';
 				echo '<pre>        if not missing(rou01[i]) then rou01[i] = round(rou01[i], 0.1); </pre>';
 				echo '<pre>    end; </pre>';
 			}

 			if (isset($round2)) {
 				echo '<pre>    *** round to 0.01 ***; </pre>';
 				echo '<pre>    array rou001 [*] ' . implode(' ', $round2) . '; </pre>';
 				echo '<pre>    do i=1 to dim(rou001); </pre>';
 				echo '<pre>        if not missing(rou001[i]) then rou001[i] = round(rou001[i], 0.01); </pre>';
 				echo '<pre>    end; </pre>';
 			}

 			if (isset($round3)) {
 				echo '<pre>    *** round to 0.001 ***; </pre>';
 				echo '<pre>    array rou0001 [*] ' . implode(' ', $round3) . '; </pre>';
 				echo '<pre>    do i=1 to dim(rou0001); </pre>';
 				echo '<pre>        if not missing(rou0001[i]) then rou0001[i] = round(rou0001[i], 0.001); </pre>';
 				echo '<pre>    end; </pre>';
 			}

 			if (isset($miss99)) {
 				echo '<pre>    *** impute missing as -99 ***; </pre>';
 				echo '<pre>    array miss99 [*] ' . implode(' ', $miss99) . '; </pre>';
 				echo '<pre>    do i=1 to dim(miss99); </pre>';
 				echo '<pre>        if missing(miss99[i]) then miss99[i] = -99; </pre>';
 				echo '<pre>    end; </pre>';
 			}

                  if (isset($round4)) {               
                        echo '<pre>    *** round to 4 significant digits ***; </pre>';
                        echo '<pre>    array rou4sd[*] ' . implode(' ', $round4) . '; </pre>';
                        echo '<pre>    do i=1 to dim(rou4sd); </pre>';
                        echo '<pre>        if rou4sd[i] not in (0 .) then do; </pre>';
                        echo '<pre>            if int(rou4sd[i]) ne 0 then rou4sd[i]=round(rou4sd[i], 10**(int(log10(abs(rou4sd[i])))-3)); </pre>';
                        echo '<pre>            else rou4sd[i]=round(rou4sd[i],10**(-1*(abs(int(log10(abs(rou4sd[i]))))+4))); </pre>';
                        echo '<pre>        end; </pre>';
                        echo '<pre>    end; </pre>';
                  }     
	

 			if (isset($round5)) {
 				echo '<pre>    *** round to 3 significant digits ***; </pre>';
 				echo '<pre>    array rou3sd[*] ' . implode(' ', $round5) . '; </pre>';
 				echo '<pre>    do i=1 to dim(rou3sd); </pre>';
 				echo '<pre>        if not missing(rou3sd[i]) then do; </pre>';
 				echo '<pre>            if int(rou3sd[i]) ne 0 then rou3sd[i]=round(rou3sd[i], 10**(int(log10(abs(rou3sd[i])))-2));
 				</pre>';
 				echo '<pre>            else rou3sd[i]=round(rou3sd[i],10**(-1*(abs(int(log10(abs(rou3sd[i]))))+3)));
 				</pre>';
 				echo '<pre>        end; </pre>';
 				echo '<pre>    end; </pre>';

 			}	

                  if (isset($round6)) {
                        echo '<pre>    *** round to 1 ***; </pre>';
                        echo '<pre>    array rou1 [*] ' . implode(' ', $round6) . '; </pre>';
                        echo '<pre>    do i=1 to dim(rou1); </pre>';
                        echo '<pre>        if not missing(rou1[i]) then rou1[i] = round(rou1[i], 1); </pre>';
                        echo '<pre>    end; </pre>';
                  }
		?>

		<pre>run; </pre>
		<br />

		<pre><font size="4" color="red">* --------------------- final dataset ---------------- *; </font></pre>
		<pre>proc sort data = your_dataset_name ;</pre>
		<pre>    by <?php echo $dataset_sort; ?>; </pre>
            
		<pre>run; </pre>
		<pre>data derived.<?php echo $dataset_name?> (label="<?php echo $dataset_label ?>") ; </pre>
		<pre>    retain <?php echo $vars ?> ;</pre>
		<pre>    set your_dataset_name ; </pre>
		<pre>    keep <?php echo $vars ?> ;</pre>
		<?php
     		foreach ($varlabels as $label) {
     			echo '<pre>    label  ' . $label . ' ; </pre>';  
     		}
		?>
		<pre>run; </pre>
		</div>
	</body>

</html>