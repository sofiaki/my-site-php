<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:decimal-format name="euro" decimal-separator="," grouping-separator="."/>
<xsl:output method = "html"></xsl:output>
<xsl:template match="/semesterStudents">
<!--Variable for the top 2 students-->
<xsl:variable name="top1" select="/semesterStudents/top2[1]/@idT" />
<xsl:variable name="top2" select="/semesterStudents/top2[2]/@idT" />

	
		
		<div class="row m-2">
			<p>
			Total students of semester: 
			<xsl:value-of select="count(/semesterStudents/student)"/><br/>
			Grade average of all studnets: 
			<xsl:value-of select="sum(/semesterStudents/student/average) div count(/semesterStudents/student)"/>
			</p>
		</div>
		<!--Student table-->
		<div class="row m-2">
			<table class="table">
				<thead class="thead-light">
					<tr>
						<th style="text-align:center">Name</th>	  
						<th style="text-align:center">Surname</th>	
						<th style="text-align:center">Total courses</th>	
						<th style="text-align:center">Average grade for this semester</th>				
						
					</tr>		
				</thead>
				<tbody>
					<xsl:for-each select="student">
					<!--If student id matches top1 or top2 the table row gets coloured green-->					
						<xsl:choose>
						<xsl:when test="@id=$top1 or @id=$top2">
							<tr bgcolor="lightgreen">	
								<td style="text-align:center"><xsl:value-of select="name"/></td>
								<td style="text-align:center"><xsl:value-of select="surname"/></td>
								<td style="text-align:center"><xsl:value-of select="$top1"/></td>
								<td style="text-align:center"><xsl:value-of select="format-number(average,'0.00')"/></td>
							</tr>	
						</xsl:when>
						<xsl:otherwise>
							<tr>	
								<td style="text-align:center"><xsl:value-of select="name"/></td>
								<td style="text-align:center"><xsl:value-of select="surname"/></td>
								<td style="text-align:center"><xsl:value-of select="courses"/></td>
								<td style="text-align:center"><xsl:value-of select="format-number(average,'0.00')"/></td>
							</tr>
						</xsl:otherwise>
						</xsl:choose>					
					</xsl:for-each>
				</tbody>
			</table>
		</div>	
	
	

</xsl:template>
</xsl:stylesheet>